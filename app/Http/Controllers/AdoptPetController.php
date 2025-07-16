<?php

namespace App\Http\Controllers;

use App\Enums\PetColourEnum;
use App\Enums\PetSpeciesEnum;
use App\Http\Requests\AdoptPetRequest;
use App\Models\Pet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class AdoptPetController extends Controller
{
    /**
     * Display the pet adoption form.
     *
     * @return Response
     */
    public function create(): Response
    {
        $user = Auth::user();
        $petCount = Pet::where('user_id', $user->id)->count();
        $maxPets = AdoptPetRequest::MAX_PETS_PER_USER;

        return Inertia::render('pets/AdoptPet', [
            'species' => $this->getSpeciesOptions(),
            'colours' => $this->getColourOptions(),
            'userPetCount' => $petCount,
            'maxPets' => $maxPets,
        ]);
    }

    /**
     * Store a newly created pet.
     *
     * @param AdoptPetRequest $request
     * @return RedirectResponse
     */
    public function store(AdoptPetRequest $request): RedirectResponse
    {
        try {
            // Request is already validated by AdoptPetRequest
            $user = $request->user();
            
            // Create the pet with validated data
            $pet = Pet::createForUser($user, $request->validated());
            
            // Redirect with success message
            return redirect()->route('pets.index')
                ->with('success', 'Congratulations! You have successfully adopted ' . $pet->name . '!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Pet adoption failed: ' . $e->getMessage());
            
            // Redirect back with error
            return back()->withErrors([
                'error' => 'There was a problem adopting your pet. Please try again.'
            ])->withInput();
        }
    }

    /**
     * Get all available pet species as options for the form.
     *
     * @return array
     */
    private function getSpeciesOptions(): array
    {
        $options = [];
        
        foreach (PetSpeciesEnum::cases() as $species) {
            $options[] = [
                'value' => $species->value,
                'label' => $species->name,
            ];
        }
        
        return $options;
    }

    /**
     * Get all available pet colours as options for the form.
     *
     * @return array
     */
    private function getColourOptions(): array
    {
        $options = [];
        
        foreach (PetColourEnum::cases() as $colour) {
            $options[] = [
                'value' => $colour->value,
                'label' => $colour->name,
            ];
        }
        
        return $options;
    }
}