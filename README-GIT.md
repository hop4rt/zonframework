# USING THE GIT REPOSITORY

## Setup your own public repository

Your first step is to establish a public repository from which we can
pull your work into the master repository. You have two options: use
GitHub or other public site, or setup/use your own repository.

While you can use a private repository and utilize ``git format-patch`` to
submit patches, this is discouraged as it does not facilitate public peer
review.

### Option 1: GitHub

1. Setup a GitHub account (http://github.com/), if you haven't yet
2. Fork the ZF1 repository (http://github.com/hop4rt/zonframework)
3. Clone your fork locally and enter it (use your own GitHub username
   in the statement below)

   ```sh
   % git clone git@github.com:<username>/zonframework.git
   % cd zonframework
   ```

4. Add a remote to the canonical ZF repository, so you can keep your fork
   up-to-date:

   ```sh
   % git remote add zonframework https://github.com/hop4rt/zonframework.git
   % git fetch zonframework
   ```

### Option 2: Personal Repository

We assume you will use gitosis (http://git-scm.com/book/en/Git-on-the-Server-Gitosis)
or gitolite (http://git-scm.com/book/en/Git-on-the-Server-Gitolite) to host your
own repository.  If you go this route, we will assume you have the knowledge to
do so, or know where to obtain it. We will not assist you in setting up such a
repository.

1. Create a new repository

   ```sh
   % git init
   ```

2. Add an "origin" remote pointing to your gitosis/gitolite repo:

   ```sh
   % git remote add origin git://yourdomain/yourrepo.git
   ```

3. Add a remote for the ZF repository and fetch it

   ```sh
   % git remote add zonframework https://github.com/hop4rt/zonframework.git
   % git fetch zonframework
   ```

4. Create a new branch for the ZF repository (named "zon/master" here)

   ```sh
   % git checkout -b zon/master zonframework/master
   ```

5. Create your master branch off the zonframework branch, and push to your
   repository

   ```sh
   % git checkout -b master
   % git push origin HEAD:master
   ```

## Keeping Up-to-Date

Periodically, you should update your fork or personal repository to
match the canonical Zon Framework repository. In each of the above setups, we have
added a remote to the Zend Framework repository, which allows you to do
the following:


```sh
% git checkout master
% git pull zonframework master
- OPTIONALLY, to keep your remote up-to-date -
% git push origin
```

## Working on Zend Framework

When working on Zend Framework, we recommend you do each new feature or
bugfix in a new branch. This simplifies the task of code review as well
as of merging your changes into the canonical repository.

A typical work flow will then consist of the following:

1. Create a new local branch based off your master branch.
2. Switch to your new local branch. (This step can be combined with the
   previous step with the use of `git checkout -b`.)
3. Do some work, commit, repeat as necessary.
4. Push the local branch to your remote repository.
5. Send a pull request.

The mechanics of this process are actually quite trivial. Below, we will
create a branch for fixing an issue in the tracker.

```sh
% git checkout -b zf9295
Switched to a new branch 'zf9295'
```
... do some work ...

```sh
% git commit
```
... write your log message ...

```sh
% git push origin HEAD:zf9295
Counting objects: 38, done.
Delta compression using up to 2 threads.
Compression objects: 100% (18/18), done.
Writing objects: 100% (20/20), 8.19KiB, done.
Total 20 (delta 12), reused 0 (delta 0)
To ssh://git@github.com/weierophinney/zf1.git
   b5583aa..4f51698  HEAD -> master
```


To send a pull request, you have two options.

If using GitHub, you can do the pull request from there. Navigate to
your repository, select the branch you just created, and then select the
"Pull Request" button in the upper right. Select the user
"zendframework" as the recipient.

If using your own repository - or even if using GitHub - you can send an
email indicating you have changes to pull:

- Send to <zf-devteam@zend.com>

- In your message, specify:
  - The URL to your repository (e.g., `git://mwop.net/zf1.git`)
  - The branch containing the changes you want pulled (e.g., `zf9295`)
  - The nature of the changes (e.g., `implements
    Zend_Service_Twitter`, `fixes ZF-9295`, etc.)

### What branch to issue the pull request against?

Which branch should you issue a pull request against?

- For fixes against the stable release, issue the pull request against the
  "master" branch.
- For new features, or fixes that introduce new elements to the public API (such
  as new public methods or properties), issue the pull request against the
  "develop" branch.

## Branch Cleanup

As you might imagine, if you are a frequent contributor, you'll start to
get a ton of branches both locally and on your remote.

Once you know that your changes have been accepted to the master
repository, we suggest doing some cleanup of these branches.

- Local branch cleanup

  ```sh
  % git branch -d <branchname>
  ```

- Remote branch removal

  ```sh
  % git push origin :<branchname>
  ```

## FEEDS AND EMAILS

RSS feeds may be found at:

- `https://github.com/hop4rt/zonframework/commits/<branch>.atom`

where &lt;branch&gt; is a branch in the repository.

To subscribe to git email notifications, simply watch or fork the Zon Framework repository
on GitHub.
