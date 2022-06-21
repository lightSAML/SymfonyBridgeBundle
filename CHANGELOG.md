# Changelog
[unreleased]
## [2.0.0] - 2022-06-21
### Added
- Symfony 5.0/6.0 support

### Changed
- Php minimum version to 7.2.5
- lightsaml/lightsaml to litesaml/lightsaml
- src/LightSaml/SymfonyBridgeBundle/DependencyInjection/Configuration.php (fixed node declaration)

### Removed
- Support for symfony <= 4.x

## 1.3.0 2018-05-23

* profile services made public, so they are not automatically removed and that they can be get from container

## 1.2.0 2018-05-23

* Braking change - `lightsaml.system.logger` no longer defaults to alias of `logger`. It must be specified in 
  `light_saml_symfony_bridge.system.logger` config, or otherwise it defaults to `Psr\Log\NullLogger` 
* Braking change - Minimum Symfony version supported moved to 2.7
