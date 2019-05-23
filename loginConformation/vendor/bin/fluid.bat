@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../typo3fluid/fluid/bin/fluid
php "%BIN_TARGET%" %*
