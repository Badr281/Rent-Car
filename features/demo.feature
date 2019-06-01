# This file contains a user story for demonstration only.
# Learn how to get started with Behat and BDD on Behat's website:
# http://behat.org/en/latest/quick_start.html

Feature:
  In order to check in application
  As a user
  I want to access on different pages

  Scenario: A user can access to index page
    When  sends a request to  path "/"
    Then the status code should be "200"

  Scenario: An anounymous user cannot authenticate without registration account
    When sends a request to  path "/connect/google/check"
    Then the status code should be "302"
    Then I should be redirected to "/Register"

  Scenario: A user can see his registred cars 
    When  sends a request to  path "/car/show/14"
    Then the status code should be "302"
    Then my page should contains "de la voiture le la voiture"

    


    


   
