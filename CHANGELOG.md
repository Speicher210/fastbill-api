# Changelog

All Notable changes to `speicher210/fastbill-api` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [Unreleased]

## [1.2.0] - 2016-03-21

### Changed
- RequestsData for services now have a default limit of 100.
- Throw exception in the services if the API response contains errors.

### Added
- Added constants and helper methods for models.
- Added account hash to `ApiCredentials`.
- [BC BREAK] Added method `getCredentials` to `TransportInterface`.
- Added method to get the article checkout URL for a customer (Article service).

## [1.1.0] - 2016-02-03

### Fixed
- Fixed handling \DateTime fields deserialization when they are empty strings.

## [1.0.0] - 2016-01-18

### Added
- Initial release.
