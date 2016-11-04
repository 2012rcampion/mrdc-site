---
layout: page
title: Team Registration
permalink: /register/
menu_title: Register
menu_position: 5
scripts: [bootstrap-validator]
---

# Information for Teams

Thank you for your interest in the Midwestern Robotics Design Competition (MRDC).
The deadline for registration is January 18th, 2016. Please also note that a $100 check made payable to the University of Illinois 
is required in order to be registered, which must also be received by January 18th. The check is returned to you if you attend the competition.
More details are on the registration form.

In order to enter, please complete the registration form below.

Please fill out the form completely. T-Shirts will be assigned based upon choices submitted here.
Course information is already available.  We post information in three locations, one of which is under the News tab above.
You can also check our [Facebook page]({{ site.facebook }}) or join the [mailing list]({{ site.email_teams_signup }}) to keep up to date.

# Registration Form

<form data-toggle="validator" role="form" action="http://mrdc.ec.illinois.edu/php-db-test/" method="post">
  <div class="well">
    <legend>Team Information</legend>
    <div class="form-group form-row-group">
      <label for="inputTeamName" class="control-label">Team Name</label>
      <div class="row">
        <div class="form-group col-sm-8">
          <input type="text" class="form-control" id="inputTeamName" name="TeamName" placeholder="Full Name" required>
        </div>
        <div class="form-group col-sm-4">
          <input type="text" class="form-control" id="inputTeamAbbr" name="TeamAbbr" placeholder="Acronym">
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="inputTeamSchool" class="control-label">School</label>
      <input type="text" class="form-control" id="inputTeamSchool" name="TeamSchool" placeholder="" required>
    </div>
    <div class="form-group">
      <label for="inputTeamEmail" class="control-label">Contact Email</label>
      <input type="email" class="form-control" id="inputTeamEmail" placeholder="" data-error="Please enter a valid email address" required>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="well">
    <legend>Team Members</legend>
    <p>Your team may have as many people as you like, but only the team captain and five official members listed here will be allowed in the pit area during the competition.</p>
    {% assign sizes = 'S,M,L,XL,XXL' | split: ',' %}
    <div class="row">
      <div class="form-group form-row-group col-sm-7">
          <label class="control-label">Name</label>
      </div>
      <div class="form-group form-row-group col-sm-5">
          <label class="control-label">T-shirt Size</label>
      </div>
    </div>
    {% for i in (1..6) %}
      <div class="row">
        <div class="form-group col-sm-7">
          <input type="text" class="form-control" name="Member{{i}}Name"
            placeholder="{% if i == 1 %}Team Captain{% else %}Team Member {{i}}{% endif %}">
        </div>
        <div class="form-group col-sm-5">
          <div class="btn-group btn-group-justified" data-toggle="buttons">
            {% for size in sizes %}
              <label class="btn btn-sm btn-default">
                <input type="radio" name="Member{{i}}Size" value="{{size}}">{{size}}
              </label>
            {% endfor %}  
          </div>
        </div>
      </div>
    {% endfor %}
    <p>You may optionally register a faculty/corporate sponsor or a parent.  The sponsor will be allowed in the pit area during the competition, but will not be allowed to help with the robot.</p>
    <div class="row">
    <div class="form-group col-sm-7">
      <label class="control-label">Name</label>
      <input type="text" class="form-control" name="SponsorName"
        placeholder="Sponsor">
    </div>
    <div class="form-group col-sm-5">
      <label class="control-label">T-shirt Size</label>
      <div class="btn-group btn-group-justified" data-toggle="buttons">
        {% for size in sizes %}
          <label class="btn btn-sm btn-default">
            <input type="radio" name="SponsorSize" value="{{size}}">{{size}}
          </label>
        {% endfor %}  
      </div>
    </div>
  </div>
    
    
    
    <div class="form-group">
      <label for="inputPassword" class="control-label">Password</label>
      <div class="form-inline row">
        <div class="form-group col-sm-6">
          <input type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password">
          <div class="help-block">Minimum of 6 characters</div>
        </div>
        <div class="form-group col-sm-6">
          <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm">
          <div class="help-block with-errors"></div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="radio">
        <label>
          <input type="radio" name="underwear">
          Boxers
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="underwear">
          Briefs
        </label>
      </div>
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="terms" data-error="Before you wreck yourself">
          Check yourself
        </label>
        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
