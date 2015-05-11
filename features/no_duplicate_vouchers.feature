Feature: There are no duplicate active vouchers
  As an advertiser
  I want to not have two live vouchers that are the same code but different offers
  In order to not confuse my customers

  Rules:
  - Voucher code is unique for active campaigns
  - A voucher code can be reused after a campaign has finished
  - start date is compulsory when creating a promotion
  - rename status to isDeleted or some such thing for clarity

  Background:
    Given there are advertisers:
      | name | id |
      | O2   | 1  |

  @domain
  Scenario: Advertiser adds new non-existing voucher code
    Given I am an advertiser "O2"
    When I attempt to create a promotion with the code "a123", start date "2015-01-01", end date "2016-01-01"
    Then I should have a promotion for an advertiser "O2" with the code "a123", start date "2015-01-01", end date "2016-01-01"
