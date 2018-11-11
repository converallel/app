# [Project Title]

[Insert one Paragraph of project description]

## Workflow

### Basic Setup
* Clone the project to your machine.

  ```bash
  git clone <repo url>
  ```
* Install all the dependencies. If composer is installed globally, run:
  ```bash
  composer install
  ```
  , else download `composer.phar` and run:
  ```bash
  php composer.phar install
  ```
* Create a database.
* Edit `config/app.php`, set up the `'Datasources'` and any other configuration relevant for your application.
* Create the database tables:
  ```bash
  bin/cake migrations migrate
  ```
* You can now either use your machine's webserver to view the web page, or start
  up the built-in webserver with:
  ```bash
  bin/cake server -p 8765
  ```
  Then visit `http://localhost:8765` to see the web page.

***
***All steps below should only be performed after you've done the basic setup.***

### Feature Branch

* Create a new branch from the *master* branch and checkout the new branch.

  ```bash
  git checkout -b <your branch name>
  ```
* Update your database tables:
  ```bash
  bin/cake migrations migrate
  ```
* Start coding.
* Record changes in the database:
  ```bash
  bin/cake bake migration_diff [name] # Name should be descriptive, e.g AddPriceToProducts
  ```
  You should always check the code generated in `config/Migrations`,
  the list of thing to check for include but are not limited to the following:
  
  * Some columns types are encoded in a way that will raise errors if we try to `migrate` them, 
    e.g. Special integer types (tiny, small, etc.) are encoded as 'tinyinteger', 'smallinteger', 
    you will need to change them to 'integer' and set 'limit' option to MysqlAdapter::INT_[TYPE].
    
    For More information, see [Valid Column Types](https://book.cakephp.org/3.0/en/phinx/migrations.html#id2) 
    and [Limit Options](https://book.cakephp.org/3.0/en/phinx/migrations.html#limit-option-and-mysql).
  * `char` and `bit` are encoded as `string`, manually change them back to their original types.
  * Auto-increment option is not included for special integer types, manually add `'autoIncrement' => true`
    to options.
  * Timestamp `on update` is not included by default, manually add `'update' => 'CURRENT_TIMESTAMP'`
    to the options.
  * Procedures, triggers, views, etc. are not generated, use `$this->execute(...)` to add them. 
    (Remember to add them in `down()` as well)
  
  
* If you want to include test data from your database, run:
  ```bash
  bin/cake bake seed [--data] [--fields id,title,excerpt] [--limit 10] [TableName]
  ```
* Push all the changes to your branch:
  ```bash
  git add .
  git commit -m <message>
  git push -u origin <your branch>
  ```
* When ready to integrate your branch, open a pull request to merge your branch into the *integration* branch.
* If the automated tests passed (All *Status Checks* passed), 
you will wait for members of the QA team to approve the pull request, once approved, you can merge the pull reqeust.
* If tests failed, resolves the problems and push the fixes back to your branch. 
Pull request does *not* need to be closed, once changes are pushed, the tests will be rerun.

### Hotfix
***You must be in the Hotfix team to push to master, ask the repo manager for permission to do so.***
* Create a branch from the *master* branch, branch name should start with the prefix "hotfix-", e.g. "hotfix-1.2".
* Push fixes to the hotfix branch.
* Open a pull request (1) to merge the hotfix branch into the *master* branch.
* Open a pull request (2) to merge the hotfix branch into the *integration* branch.
* Once the automated tests passed, you can merge pull request (1).
* Pull request (2) will be subjected to the same revision process as that of a feature branch.
* Tag the master branch, e.g. "v1.2".

### QA
* Members of the QA team will be notified when a pull request on the integration branch is opened.
* Test the pull request on the test server, code for the current pull request can be found in 
`/var/www/html/<project>/<head branch>`.
* If tested okay, approve the pull request in the pull request panel.
* The pull request can be merged at this point by anyone.
* Tag the integration branch, e.g. "v1.2.3".

### Release
* Open a pull request to merge the integration branch into the master branch.
* Automated tests will be run, it is expected that the tests will pass 
as the code in the integration branch should be fully tested.
* Merge the pull request.
* Tag the master branch, e.g. "v1.3".