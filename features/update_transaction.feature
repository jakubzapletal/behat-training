Feature: Updating transactions
    As an Awin
    I want to have updated transaction
    So I can process that transaction

    Scenario: Update transaction
        Given there are new transactions:
            | date       | checksum | mid    |
            | 2015-01-02 | 54886314 | 106651 |
            | 2015-02-03 | 54886315 | 106651 |
            | 2015-03-03 | 54886320 | 104814 |
        When I run processing an update
        Then I should have:
            | date                | checksum | mid    |
            | 2015-01-02 00:00:00 | 54886314 | 106651 |
            | 2015-02-03 00:00:00 | 54886315 | 106651 |
            | 2015-03-03 00:00:00 | 54886320 | 104814 |