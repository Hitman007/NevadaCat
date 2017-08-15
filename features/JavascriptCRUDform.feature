Feature: New 'feline' CPT JavaScript input form

As user
I want to be able to enter information into a 3-4 view JS view "panel"
So that I can create a feline CPT

Scenario: View the panel, I am logged out
   Given there is a view JS view "panel"
   And I am logged out
   When I visit the page "add-cat"
   Then I should see the enter email view

Scenario: View the panel, I am logged in
   Given there is a view JS view "panel"
   And I am logged in
   When I visit the page "add-cat"
   Then I should see the enter a name view