# Design Document

## Overview

The "Adopt a Pet" feature enables users to create new virtual pets through an intuitive web interface. This feature integrates with the existing Larapets application, leveraging Laravel's backend capabilities and Vue.js frontend to provide a seamless pet creation experience. The design follows the established patterns in the application while introducing new components for pet customization and adoption workflow.

## Architecture

### Backend Architecture
- **Controller**: `AdoptPetController` handles pet creation requests and form validation
- **Model**: Extends existing `Pet` model with adoption-specific methods
- **Validation**: Custom form request class for pet creation validation
- **Route**: RESTful routes for displaying adoption form and processing submissions
- **Middleware**: Leverages existing authentication middleware

### Frontend Architecture
- **Page Component**: `AdoptPet.vue` serves as the main adoption interface
- **Form Components**: Reusable components for pet customization
- **Preview Component**: Real-time pet preview with selected attributes
- **Navigation**: Integration with existing navigation structure

### Data Flow
1. User navigates to adopt pet page via authenticated route
2. Frontend loads pet customization form with available options
3. User selects pet attributes with real-time preview updates
4. Form submission triggers backend validation and pet creation
5. Successful adoption redirects to user's pets page with confirmation

## Components and Interfaces

### Backend Components

#### AdoptPetController
```php
class AdoptPetController extends Controller
{
    public function create(): Response
    public function store(AdoptPetRequest $request): RedirectResponse
}
```

#### AdoptPetRequest
```php
class AdoptPetRequest extends FormRequest
{
    public function rules(): array
    public function messages(): array
}
```

#### Pet Model Extensions
```php
// Additional methods for adoption
public static function createForUser(User $user, array $attributes): Pet
public function initializeDefaultStats(): void
public static function isNameUnique(string $name): bool
```

### Frontend Components

#### AdoptPet.vue (Main Page)
- Form handling with reactive data
- Real-time validation feedback
- Pet preview integration
- Navigation breadcrumbs

#### PetCustomizer.vue
- Species selection dropdown
- Color picker interface
- Name input with validation
- Attribute preview

#### PetPreview.vue
- Visual representation of selected pet
- Dynamic updates based on form changes
- Placeholder for future pet sprites/images

### API Interfaces

#### GET /adopt-pet
```typescript
interface AdoptPetPageProps {
  species: PetSpecies[]
  colors: PetColor[]
  userPetCount: number
  maxPets: number
}
```

#### POST /adopt-pet
```typescript
interface AdoptPetRequest {
  name: string
  species: PetSpecies
  color: PetColor
}

interface AdoptPetResponse {
  success: boolean
  pet?: Pet
  errors?: ValidationErrors
}
```

## Data Models

### Pet Model Updates
```php
// Existing Pet model with new adoption-related fields/methods
class Pet extends Model
{
    protected $fillable = [
        'name',
        'species', 
        'color',
        'user_id',
        'hunger',
        'health', 
        'level',
        'experience'
    ];

    protected $casts = [
        'species' => PetSpecies::class,
        'color' => PetColor::class,
    ];

    // Default stats for new pets
    const DEFAULT_STATS = [
        'hunger' => 100,
        'health' => 100,
        'level' => 1,
        'experience' => 0
    ];
}
```

### Enums
```php
enum PetSpecies: string
{
    case BROAV = 'broav';
    case GALWRIS = 'galwris';
    case HABIF = 'habif';
    case AGHOIR = 'aghoir';
}
```

### Validation Rules
- **Name**: Required, string, 1-50 characters, unique across all pets
- **Species**: Required, valid PetSpecies enum value
- **Color**: Required, valid PetColor enum value
- **User Pet Limit**: Maximum 3 pets per user

## Error Handling

### Validation Errors
- **Empty Name**: "Pet name is required"
- **Name Too Long**: "Pet name must be 50 characters or less"
- **Duplicate Name**: "This pet name is already taken"
- **Invalid Species**: "Please select a valid pet species"
- **Invalid Color**: "Please select a valid pet color"
- **Pet Limit Exceeded**: "You can only have 3 pets maximum"

### Server Errors
- **Database Connection**: Generic error message with retry option
- **Unexpected Errors**: Graceful fallback with error logging
- **Session Timeout**: Redirect to login with return URL

### Frontend Error States
- Form validation errors displayed inline
- Global error notifications for server issues
- Loading states during form submission
- Disabled form submission for invalid data

## Testing Strategy

### Backend Testing
```php
// Feature Tests
class AdoptPetTest extends TestCase
{
    public function test_authenticated_user_can_view_adopt_page()
    public function test_unauthenticated_user_redirected_to_login()
    public function test_user_can_create_pet_with_valid_data()
    public function test_pet_name_must_be_unique()
    public function test_user_cannot_exceed_pet_limit()
    public function test_pet_created_with_default_stats()
}

// Unit Tests
class PetModelTest extends TestCase
{
    public function test_pet_name_validation()
    public function test_default_stats_initialization()
    public function test_species_enum_casting()
}
```

### Frontend Testing
```typescript
// Component Tests
describe('AdoptPet.vue', () => {
  it('displays pet customization form')
  it('validates pet name input')
  it('updates preview when attributes change')
  it('submits form with correct data')
  it('displays validation errors')
})

// Integration Tests
describe('Pet Adoption Flow', () => {
  it('completes full adoption process')
  it('redirects to pets page after success')
  it('handles server errors gracefully')
})
```

### Test Data
- Factory for creating test pets with various attributes
- Seeder for populating species and color options
- Mock user accounts with different pet counts
- Edge case scenarios (boundary values, invalid data)

## Security Considerations

### Authentication & Authorization
- Route protection via `auth` middleware
- User can only create pets for their own account
- CSRF protection on form submissions

### Input Validation
- Server-side validation for all pet attributes
- SQL injection prevention through Eloquent ORM
- XSS protection via Laravel's built-in escaping

### Rate Limiting
- Prevent rapid pet creation attempts
- Standard Laravel rate limiting on routes

## Performance Considerations

### Database Optimization
- Index on pet names for uniqueness checks
- Efficient queries for user pet counts
- Minimal database calls during form rendering

### Frontend Optimization
- Lazy loading of pet preview assets
- Debounced validation for name uniqueness
- Optimized bundle size for adoption components

### Caching Strategy
- Cache species and color options
- Session-based form state preservation
- Static asset caching for pet preview images