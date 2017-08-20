---
layout: page
title: For Teams
permalink: /team_info/
menu_title: For Teams
scripts: [bootstrap-validator, register]
---

# Team Registration

Thank you for your interest in the Midwestern Robotics Design Competition. The 2017 MRDC has completed and preparations for the 2018 MRDC are underway. 

Sign up for the [mailing list]({{ site.email_teams_signup }}) or check our [Facebook page]({{ site.facebook }}) to stay up to date.

<!-- Uncomment the below block when registration is open and change the dates/info as appropriate. -->

<!--
Thank you for your interest in the Midwestern Robotics Design Competition (MRDC).
The deadline for registration is January 18th, 2017. Please note that the $100
deposit check, made payable to the Midwestern Robotics Design Competition,
is required in order for your registration to be completed.  The check must be
received by the January 18th deadline. The check is returned to you if you
attend the competition.  See the registration form for details.

In order to enter, please complete the registration form below.

Please fill out the form completely. T-shirts will be assigned based upon
choices submitted here.  Course information is already available.  We post
information in three locations, one of which is under the News tab above.
You can also check our [Facebook page]({{ site.facebook }}) or join the
[mailing list]({{ site.email_teams_signup }}) to keep up to date.

# Registration Form

<form data-toggle="validator" role="form" action="{{ site.baseurl }}/register_submit.php" method="post">
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
      <input type="email" class="form-control" id="inputTeamEmail" name="TeamEmail" placeholder="" data-error="Please enter a valid email address" required>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="well">
    <legend>Team Members</legend>
    <p>Your team may have as many people as you like, but only the team captain and five official members listed here will be allowed in the pit area during the competition.</p>
    {% assign sizes = 'S,M,L,XL,XXL' | split: ',' %}
    {% for i in (1..6) %}
      <div class="form-group">
        <label class="control-label">
          {% if i == 1 %}
            Team Captain
          {% else %}
            Team Member {{i}}
          {% endif %}
        </label>
        <input type="text" class="form-control collapse-control" name="Member{{i}}Name" placeholder="Name" {% if i == 1 %}required{% endif %}>
      </div>
      <div>
        <div class="form-group">
          <input type="email" class="form-control" name="Member{{i}}Email" placeholder="Email" data-error="Please enter a valid email address">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <input type="tel" class="form-control" name="Member{{i}}Phone" placeholder="Phone Number" data-error="Please enter a valid phone number" pattern="([^0-9]*[0-9]){10}.*">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <span class="control-label">T-shirt size: </span>
          <div class="btn-group" data-toggle="buttons">
            {% for size in sizes %}
              <label class="btn btn-sm btn-default">
                <input type="radio" name="Member{{i}}Size" value="{{size}}">{{size}}
              </label>
            {% endfor %}  
          </div>
          <div class="help-block with-errors"></div>
        </div>
      </div>
    {% endfor %}
    <p>You may optionally register a faculty/corporate sponsor or a parent.  The sponsor will be allowed in the pit area during the competition, but will not be allowed to help with the robot.</p>
    <div class="form-group">
        <label class="control-label">Sponsor</label>
        <input type="text" class="form-control collapse-control" name="SponsorName" placeholder="Name">
      </div>
      <div>
        <div class="form-group">
          <input type="email" class="form-control" name="SponsorEmail" placeholder="Email" data-error="Please enter a valid email address">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <input type="tel" class="form-control" name="SponsorPhone" placeholder="Phone Number" data-error="Please enter a valid phone number" pattern="([^0-9]*[0-9]){10}.*">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <span class="control-label">T-shirt size: </span>
          <div class="btn-group" data-toggle="buttons">
            {% for size in sizes %}
              <label class="btn btn-sm btn-default">
                <input type="radio" name="SponsorSize" value="{{size}}">{{size}}
              </label>
            {% endfor %}  
          </div>
          <div class="help-block with-errors"></div>
        </div>
      </div>
  </div> 
  <div class="well">  
    <legend>Rules and Legal Acceptance</legend>
    <p>
      Prior to continuing, please familiarize yourself and your team with the competition's rules, located on the <a href="{{ site.google_drive }}">the public Google Drive</a>.
    </p>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="RulesAccept" data-error="Required" required>
          Our team has read, accepted, and will abide by the competition's rules.
        </label>
        <div class="help-block with-errors"></div>
      </div>
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="ModifyAccept" data-error="Required" required>
          Our team acknowledges that the MRDC Committee and MRDC's corporate sponsor(s) can, at any time, modify the rules and have the final authority regarding competition decisions.
        </label>
        <div class="help-block with-errors"></div>
      </div>
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="PhotoAccept" data-error="Required" required>
          Our team grants the MRDC Committee and our corporate sponsors the ability to photograph, record, and publicize our actions and robot.
        </label>
        <div class="help-block with-errors"></div>
      </div>
    </div>
    <legend>Deposit Check</legend>
    <p>
      Your team will not be officially registered until you send a check for
      $100 payable to the "Midwestern Robotics Design Competition" to the MRDC Committee at:
    </p>
    <address>
      <strong>ATTN: MRDC Director</strong><br>
      103C Engineering Hall<br>
      1308 West Green Street<br>
      Urbana, IL 61801<br>
    </address>
    <p>
      This check is not a fee, and only be cashed if your team does not attend
      the competition or causes damage to the competition venue.  Otherwise
      the check will be returned to you.
    </p>
    <p>
      Please submit <a href="https://drive.google.com/file/d/0B0VNJlWZGkwNR1c4WUJIR3l4LW8/view?usp=sharing">this deposit form</a> along with your check.
    </p>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="CheckAccept" data-error="Required" required>
          Our team has read and accepts the above registration check notice.
        </label>
        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>
  <div class="form-group text-center">
    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
  </div>
</form> 
-->
