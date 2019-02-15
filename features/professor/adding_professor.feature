@professor @domain
Feature: Adding a professor
  ...

  Scenario: Adding a coordinator professor
    When I register a coordinator professor with username "johndoe" and password "secret"
    Then the coordinator professor "johndoe" should be available

  Scenario: Adding a assistant professor
    When I register a assistant professor with username "johndoe" and password "secret"
    Then the assistant professor "johndoe" should be available

