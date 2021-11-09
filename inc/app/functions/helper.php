<?php

function isAuthenticated() {
  return Session::has("SESSION_USER_UUID") ? true : false;
}

