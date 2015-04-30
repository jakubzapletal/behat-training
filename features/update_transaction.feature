Feature: Updating transations
  As an Awin
  I want to have updated transaction
  So I can process this transaction


  @domain
  Scenario: Update transaction 1
    Given there are new transaction:
      | date       | checksum   | mid       |
      | 2015-01-01 | 5465413231 | 654654651 |
    When I run processing an update
    Then I should have:
      | date                | checksum   | mid       |
      | 2015-01-01 00:00:00 | 5465413231 | 654654651 |

  @application
  Scenario: Update transaction 2
    Given there are new transaction:
      | date       | checksum   | mid       |
      | 2015-01-02 | 5465413232 | 654654652 |
    When I run processing an update
    Then I should have:
      | date                | checksum   | mid       |
      | 2015-01-02 00:00:00 | 5465413232 | 654654652 |
