Feature: Updating transations
  As an Awin
  I want to have updated transaction
  So I can process this transaction

  Scenario: Update transaction
    Given there are new transaction:
      | date       | checksum   | mid       |
      | 2015-01-01 | 5465413231 | 654654651 |
      | 2015-01-02 | 5465413232 | 654654652 |
      | 2015-01-03 | 5465413233 | 654654653 |
    When I run processing an update
    Then I should have:
      | date                | checksum   | mid       |
      | 2015-01-01 00:00:00 | 5465413231 | 654654651 |
      | 2015-01-02 00:00:00 | 5465413232 | 654654652 |
      | 2015-01-03 00:00:00 | 5465413233 | 654654653 |
