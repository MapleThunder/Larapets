# Implementation Plan

- [x] 1. Create PetSpecies enum and update existing Pet model
  - Create PetSpecies enum with broav, galwris, habif, aghoir options
  - Update Pet model to use PetSpecies enum casting
  - Add default stats constants to Pet model
  - Add static methods for pet creation and name validation
  - _Requirements: 2.4, 3.3_

- [x] 2. Create AdoptPetRequest form validation class
  - Implement validation rules for name (1-50 chars, unique), species, and color
  - Add custom validation messages for user-friendly error display
  - Include pet limit validation (max 3 pets per user)
  - _Requirements: 2.1, 2.2, 2.3, 3.7_

- [x] 3. Create AdoptPetController with create and store methods
  - Implement create method to display adoption form with species/color options
  - Implement store method to handle pet creation with validation
  - Add user pet count checking and redirect logic
  - Include proper error handling and success responses
  - _Requirements: 1.1, 3.1, 3.2, 3.4, 3.5, 3.6_

- [ ] 4. Add adoption routes with authentication middleware
  - Create GET route for adoption form display
  - Create POST route for pet creation submission
  - Apply auth middleware to protect routes from unauthenticated access
  - _Requirements: 1.2, 4.1_

- [ ] 5. Create AdoptPet.vue main page component
  - Build form with reactive data for pet name, species, and color selection
  - Implement real-time form validation with error display
  - Add form submission handling with loading states
  - Include breadcrumb navigation and page structure
  - _Requirements: 1.3, 2.1, 2.7, 2.8, 4.4, 5.1_

- [ ] 6. Create PetCustomizer.vue form component
  - Build species selection dropdown using available options
  - Create color selection interface with visual feedback
  - Implement name input field with validation feedback
  - Add hover states and visual interactions for game-like feel
  - _Requirements: 2.4, 2.5, 5.2, 5.3_

- [ ] 7. Create PetPreview.vue component for real-time preview
  - Display visual representation of selected pet attributes
  - Update preview dynamically when form values change
  - Add placeholder styling for future pet sprites/images
  - _Requirements: 2.6, 5.2_

- [ ] 8. Update navigation to include adopt pet functionality
  - Add "Adopt New Pet" action to pets page when user has less than 3 pets
  - Hide adoption option when user already has 3 pets
  - Ensure navigation loads adoption page within performance requirements
  - _Requirements: 4.2, 4.3, 4.5_

- [ ] 9. Add success confirmation and redirect functionality
  - Display celebratory confirmation message after successful adoption
  - Implement redirect to pets page after pet creation
  - Ensure consistent styling with rest of application
  - _Requirements: 3.4, 5.4, 5.5_

- [ ] 10. Write comprehensive tests for adoption functionality
  - Create feature tests for authentication, form validation, and pet creation
  - Write unit tests for Pet model methods and validation logic
  - Add frontend component tests for form behavior and user interactions
  - Test edge cases including pet limits and duplicate names
  - _Requirements: All requirements covered through testing_
