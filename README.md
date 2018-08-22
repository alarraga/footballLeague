# Symfony Authorization for RS256-Signed Tokens

This sample demonstrates how to protect endpoints in a Symfony API by verifying an incoming JWT access token signed by Auth0. The token must be signed with the RS256 algorithm and must be verified against your Auth0 JSON Web Key Set.

## Getting Started

## Install the Dependencies

Run `composer install`.

## Configure the App with your Auth0 Domain and Audience

Rename `.env.example` file to `.env`. Replace `{AUTH0_DOMAIN}` with your Auth0 domain and `{AUTH0_AUDIENCE}` with the **Identifier** you have set for your API in the Auth0 dashboard.

## Start the Application

Run `php bin/console server:run 127.0.0.1:3010` to start the server.

The API will be served at [localhost:3010](http://localhost:3010).

## Running the Sample With Docker

In order to run the example with docker you need to have `docker` installed.

You also need to set the client credentials as explained [previously](#Configure-the-app-with-your-auth0-domain-and-audience).

Execute in command line `sh exec.sh` to run the Docker in Linux, or `.\exec.ps1` to run the Docker in Windows.

## What is Auth0?

Auth0 helps you to:

* Add authentication with [multiple authentication sources](https://docs.auth0.com/identityproviders), either social like **Google, Facebook, Microsoft Account, LinkedIn, GitHub, Twitter, Box, Salesforce, amont others**, or enterprise identity systems like **Windows Azure AD, Google Apps, Active Directory, ADFS or any SAML Identity Provider**.
* Add authentication through more traditional **[username/password databases](https://docs.auth0.com/mysql-connection-tutorial)**.
* Add support for **[linking different user accounts](https://docs.auth0.com/link-accounts)** with the same user.
* Support for generating signed [Json Web Tokens](https://docs.auth0.com/jwt) to call your APIs and **flow the user identity** securely.
* Analytics of how, when and where users are logging in.
* Pull data from other sources and add it to the user profile, through [JavaScript rules](https://docs.auth0.com/rules).

## Create a free Auth0 account

1. Go to [Auth0](https://auth0.com/signup) and click Sign Up.
2. Use Google, GitHub or Microsoft Account to login.

## Issue Reporting

If you have found a bug or if you have a feature request, please report them at this repository issues section. Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

## Author

[Auth0](https://auth0.com)

## License

This project is licensed under the MIT license. See the `LICENSE` file for more info.
