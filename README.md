```bash
❯ vendor/bin/phpunit
There was 1 error:

1) tests\CreateFooTest::test_using_custom_repository
Ecotone\Messaging\Support\InvalidArgumentException: There is no repository available for aggregate: App\FooAggregate.
This happens because are multiple Repositories of given type registered, therefore each Repository need to specify which aggregate it can handle.
If this fails during Ecotone Lite tests, consider turning off default In Memory implementations.

--

There was 1 failure:

1) tests\CreateFooTest::test_using_default_repository
Failed asserting that an array is not empty.

ecotone-testing-with-repositories/tests/CreateFooTest.php:44

--

There was 1 risky test:

1) tests\CreateFooTest::test_unit
This test did not perform any assertions

ecotone-testing-with-repositories/tests/CreateFooTest.php:13

ERRORS!
Tests: 3, Assertions: 1, Errors: 1, Failures: 1, Risky: 1.

```
