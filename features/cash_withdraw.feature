Feature: Cash withdraw
  As an Account Holder
  I want to withdraw cash from an ATM
  So that I can get money when the bank is closed

  @domain @application
  Scenario: The withdraw is successful
    Given there is an account with 100 pounds
    And there is an ATM with 1000 pounds
    When the account holder tries to withdraw 20 pounds
    Then the account should have 80 pounds
    And the ATM should have 980 pounds
    And the account holder should have 20 pounds

