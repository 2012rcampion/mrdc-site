# MRDC public web site

## Installation

Install Ruby:

    sudo apt-get install ruby

Install bundler:

    gem install bundle

Install Node.js, either by [downloading it](https://nodejs.org/en/download/) or [through your package manager](https://nodejs.org/en/download/package-manager/).

Install bower:

    npm install -g bower
    
If you get a permissions error, [follow these instructions](https://docs.npmjs.com/getting-started/fixing-npm-permissions) to fix it; *don't* install as sudo.

Clone repository:

    git clone https://github.com/2012rcampion/mrdc-site.git

Install dependancies:

    cd mrdc-site
    bundle install
    bower install

## Build instructions

Just run:

    bundle exec jekyll build
    
And you're done!

## Deployment

Since Jekyll generates a static site, you can just copy the `_site` directory to the webserver, e.g:

    rsync -av --del -e ssh _site/ robotdesign@web.engr.illinois.edu:~/path/to/www

