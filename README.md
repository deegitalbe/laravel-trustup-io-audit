# deegitalbe/laravel-trustup-io-audit

## Installation

```shell
./composer install
```

## Available commands

Currently only composer commands are available using

```shell
./composer [your_command_goes_here]
```

## Env to add

```shell
TRUSTUP_IO_AUDIT_URL=
```

## Contract to add on desired model to add

Depends if you have defined a relation or not(ie: Media)

```shell
TrustupIoAuditRelatedModelWithRelationsContract
TrustupIoAuditRelatedModelContract
```

## Trait to add on desired model to add

Depends if you have defined a relation or not(ie: Media).
There is already defined function to avoid defining relations if you choose that way.

```shell
IsTrustupIoAuditRelatedModelWithRelations
IsTrustupIoAuditRelatedModel
```

## If you have a relation please add this column to your migration/model.

Feel free to overide it if it enter inf conflict with your project.

```shell
trustup_io_audit_log_uuids
```

## Refer to [laravel-trustup-io-external-model-relation](https://github.com/deegitalbe/laravel-trustup-io-external-model-relations#readme) if you need more documentation on how relations work.
