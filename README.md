# MRDC public web site

## Installation

Install ruby:

    sudo apt-get install ruby

Install bundler:

    gem install bundle

Clone repository:

    git clone https://github.com/2012rcampion/mrdc-site.git

Install dependancies:

    cd mrdc-site
    bundle install

## Build instructions

Just run:

    bundle exec jekyll build
    
And you're done!

## Deployment

Since Jekyll generates a static site, you can just copy the `_site` directory to the webserver, e.g:

    rsync -av --del -e ssh _site/ robotdesign@web.engr.illinois.edu:~/path/to/www

