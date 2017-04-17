Feature: Default content is added
   As the system
   I should be able to add content when the plugin is activated
   So that the default content can be accessed

Scenario: the plugin is activated
    Given there is a plugin
    And the plugin is not activated
    When the plugin is activated
    Then the default content will be visible
    
Scenario: the plugin is deactivated
    Given there is a plugin
    And the plugin is activated
    When the plugin is deactivated
    Then the default content will be deleted