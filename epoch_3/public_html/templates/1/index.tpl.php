
<!--

    World War II MMORPG
    Copyright (C) 2009-2010 Richard Eames

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

-->
<h1 class="high b">World War II Game: A New Dawn</h1>
<p>
    Welcome to the World War II Game: A New Daw, which is an online multiplayer, <br>text based strategy war game played in the browser.
    <br>This is a re-launch of the World War II Game that used to run in the last 2000's by a 3rd party
</p>
<div class="high b" style="margin-bottom: 10px; font-style: italic;">"Join a Nation and fight for your place in this world"</div>
<!-- <h2>Help Topics</h2>
<h4>I don't receive an email after 24 hours.</h4>
<p>Please make sure that you have added signups@ww2game.net to your email whitelist.</p>
<h4>When I try to activate it says my the account does not exist.</h4>
<p>Please make sure you are entering your <span style="font-weight:bold;">username</span> and not your email address. 
Also confirm that you are entering the verification password correctly; it is easy to confuse '1' (one) and 'i', 'o' and '0' (zero).</p>
<h4>I have activated my account, but when I try to log in it says I must be logged in to view that page</h4>
<p>Firstly, make sure that you are entering your <span style="font-weight:bold;">username</span> and password correctly. 
If you are sure that you are, please make sure that <a href="http://forum.ww2game.net/index.php?topic=261.0" target="_blank">cookies</a> are enable for ww2game.net</p> -->

<?php
function displayRace($race_id)
    {
        global $conf;
        $str_bonuses = '';
        foreach ($conf["race"][$race_id]["bonuses"] as $id => $amount)
            {
                if ($amount != 0) $str_bonuses .= '<div class="high">' . str_replace("@", ($amount > 0 ? "+" : ""). ($amount * 100), $conf["bonuses"][$id]) . '</div>';
            }
        return '<div class="racer">
            <div class="race-img">
                <img alt="" title="" src="' . $conf["race"][$race_id]["img"] . '" />
            </div>
            <div class="race-title high b">' . $conf["race"][$race_id]["full_name"] . '</div>
            <div class="race-desc">' . $conf["race"][$race_id]["desc"] . '</div>
            <div class="race-bonuses">' . $str_bonuses . '</div>
            <div class="race-join"><a href="register.php?nation=' . $race_id . '">Join a ' . preg_replace('/s$/', '', $conf["race"][$race_id]["name"]) . ' division!</a></div>
        </div>';
    }

?>
<div class="panel">
    <div class="race-row">
        <div class="panel-title">
            The Allies
        </div>
        <div class="race-col">
            <?= displayRace(0); ?>
            <?= displayRace(1); ?>
         </div>
    </div>
    <div class="race-row">
        <div class="panel-title">
            The Axis
        </div>
        <div class="race-col">
            <?= displayRace(2); ?>
            <?= displayRace(3); ?>
            <?= displayRace(4); ?>
        </div>
    </div>
</div>