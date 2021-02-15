# Playground Sessions Backend Code Exercise (Lumen)

## Scenario
Take this hypothetical situation.

We are making an iOS and Android app for teachers.
A teacher will select a student to see all lessons, and whether that student completed each lesson.

Each app will get its data from the JSON REST API endpoint:

```
/student-progress/{userId}
```

Where `{userId}` is the user id of the student.

You inherit this WIP codebase.

You remember how the data is structured in the database:
- Lessons are comprised of several segments.
- A user can create practice records for a segment.

You look over the codebase and realize that several problems exist in this endpoint.
1. The front-end data structures are coupled to the database structure.
1. Business rules (eg. whether a user has completed a lesson) would be duplicated by each app.
1. It is too slow, even with a reasonable amount of practice records.

Luckily, both front-end developers agree that the endpoint needs to change before it is used.
You all agree to the following data structure for the response:

```
{
  "lessons": [
    {
      "id": 32,
      "difficulty": "Rookie"
      "isComplete": true,
    }
  ]
}
```

## Instructions

Solve all three problems with this codebase.

- Create a separate data structure for the response.
- Codify the business rules.
  - A lesson is considered complete if each segment has at least one practice record with a score of 80% or more.
  - Difficulty categories ("Rookie", "Intermediate", "Advanced") are associated with difficulty numbers
    [1,2,3], [4,5,6], [7,8,9], respectively.
- Ensure the response time is under 500ms for the given dataset.  Right now the response time is about 2 seconds.

Code should be clean.
Code you write should follow the Single Responsibility Principle (SRP).
Code should be written in self-contained parts, each having one responsibility.
For example, application logic (eg. extracting query parameters from a URL)
should be separate from business logic (eg. determining if a required query parameter was supplied).

You have full reign over the codebase. You can add or remove any packages you like. 
For example, you could use a different ORM, or even a different framework, if you think that would be quicker for you.

Everything is fair game.

We are testing your ability to organize code cleanly, with SRP, not your knowledge of the Laravel/Lumen frameworks.

Try to commit often and with small changes, so we can see what you are doing.

If you have a particular strength (say documenting APIs), feel free show it off.

You might benefit from knowing that all 3 problems can be solved without use of a cache.

## Deliverables

Email ben@playgroundsessions.com with a link to your git repository.

## Getting Started

For your convenience,
we provide several approaches to quickly set up a fully operational development environment
with PHP 8.0 and MySQL 8.
- [Docker for Windows](readme/docker-windows.md)
- [Docker for MacOS](readme/docker-macos.md)
- [Ansible for Linux](readme/ansible-linux.md)
- [Do It Yourself](readme/diy.md)

We recommend one of the two Docker approaches.
However, another approach might be easier for you, if you are not familiar with Docker,
or you do not want to risk breaking your VirtualBox VMs.
- *Ansible for Linux* might be easier, if you have a fresh installation of Ubuntu 20.04 on a VM.
- *Do It Yourself* might be easier, if you like sharing your development environment between projects.

Feel free to reach out with questions about setting up your environment.

### Additional Information

Your MySQL credentials have been randomized during the `create-project` process.  Should you want them, 
they are inside the `.env` file in the root folder.

If you used Docker or Ansible, the root mysql password is the same as the playground mysql user. 

## Go!

We look forward to seeing your code! 

Personal Notes
----------------------------------------

Completed Tasks:
2-15-2021:
- Moved uncompleted changes to new branch BrokenComposerBuild to maintain a clean application version. 
- Ran "php composer.phar update" and discovered some issues in missing packages for CURL and phpunit.
- Installed missing packages and reran the composer.phar update with no issues.
2-09-2021:
- Setup a Linux Mint VM from scratch using vmware.
- Created a GIT REPO for the project at https://github.com/joshua-v-jones/PlaygroundSessions-php-exercise.
- Setup the development environment for the project using the ansible instructions.
	- Had a few roadblocks with the PHP environment. The issue lied with the PDO driver missing from the PHP installation.
	- Error 
		Explanation: After setting up the environment I could go to the index page and see the Lumen Framework page. When attempting to access http://localhost:8000/student-progress/1 I recieved a PDO error accessing the database. 
		Fix: I determined the issue lied with PHP being unable to see the PDO connection for mysql. I purged and reinstalled php and that fixed the issue.
- Made the first git commit.
- Setup eclipse in main OS using a shared folder with the Linux Mint VM.
- With a fully functional application and enviroment I could get to work.
- Being unfamiliar with Lumen entirely I needed to do a brush up course to determine how the Models were being generated from the DB schema.
- Created some notes on Lumen Migrations as I was unfamiliar.
- With much concepulization, I have a solution to decouple front end data structure from the DB by using a SQL VIEW. 
- Created the initial migration and put in skeleton code for the migration. 

IMPORTANT COMMANDS:

Creating a model migration:
(model is arbitrary in the command)
1 - run the command -> php artisan make:migration create_model_table 
	Explanation:
		This command will make a migration file that needs to be MODIFIED with our custom columns or fields to be added on the model.
2 - Modify the generated migration file at database/migrations. It has a needed timestamp for the migrations.
3 - Run the command -> php artisan migrate
	Explanation: 
		Creates the table in the DB using the migration generated and modified in step 1 and 2.
4 - Check the DB for the new Model.
5 - Create the model. in app/Model.php


USEFUL SITES:
Good getting started page to understand the schema first approach used in this example project.
https://auth0.com/blog/developing-restful-apis-with-lumen/


