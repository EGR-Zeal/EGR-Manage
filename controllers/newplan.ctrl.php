<?php

$district = str_replace("_", " ", $args["dist_name"]);
$school = str_replace("_", " ", $args["school_name"]);
$page["title"] .= "New Plan";
$page["body"] .= <<<EOD
        <h3>New Plan</h3>
        <form action="save" method="post">
            <label>
                Type:
                <select name="type">
                    <option value="solid">Solid</option>
                    <option value="tentative">Tentative</option>
                </select>
            </label>
            <textarea name="description" placeholder="Notes..."></textarea>
            <button type="submit">Save</button>
        </form>
EOD;
template("default", $page);
