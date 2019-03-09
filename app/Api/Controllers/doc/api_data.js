define({ "api": [
  {
    "type": "POST",
    "url": "/api/login",
    "title": "User Authentication",
    "name": "Authentication",
    "group": "Auth_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>Users unique ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Users Password.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Generated token on Authentication.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>store in session .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQyLCJpc3MiOiJodHRwOlwvXC9wcml2YXRlZmxpZ2h0LmNvLmluXC9hcGlcL3JlZ2lzdGVyIiwiaWF0IjoxNDU2MTMxNjE0LCJleHAiOjE0NTk3MzE2MTQsIm5iZiI6MTQ1NjEzMTYxNCwianRpIjoiNDE2Y2U1MWM4OGY5YmIzYjc3N2VhOGIxMjA0Mzc1NzEifQ.VSOMMW9gJTPXzdhGcvoRfRoIcaoeOe5aiphk5emTLlY\"\n \"STATUS_DESC\": \"Success\"\n \"STATUS_CODE\": 1\n \"email\": \"anand.vuppu@pravahya.com\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./AuthController.php",
    "groupTitle": "Auth_API_s"
  },
  {
    "type": "POST",
    "url": "/api/forgot_password",
    "title": "Forgot Password",
    "name": "Forgot_Password",
    "group": "Auth_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Users email.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>Users mobile_number.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n \"STATUS_DESC\": \"Success\"\n \"STATUS_CODE\": 1\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./AuthController.php",
    "groupTitle": "Auth_API_s"
  },
  {
    "type": "POST",
    "url": "/api/register",
    "title": "User Registration",
    "name": "Registration",
    "group": "Auth_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Users name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Users email.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>Users mobile_number.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "operator",
            "description": "<p>Users Admin.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Users Password.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>Users Password.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Generated token on Authentication.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQyLCJpc3MiOiJodHRwOlwvXC9wcml2YXRlZmxpZ2h0LmNvLmluXC9hcGlcL3JlZ2lzdGVyIiwiaWF0IjoxNDU2MTMxNjE0LCJleHAiOjE0NTk3MzE2MTQsIm5iZiI6MTQ1NjEzMTYxNCwianRpIjoiNDE2Y2U1MWM4OGY5YmIzYjc3N2VhOGIxMjA0Mzc1NzEifQ.VSOMMW9gJTPXzdhGcvoRfRoIcaoeOe5aiphk5emTLlY\"\n \"STATUS_DESC\": \"Success\"\n \"STATUS_CODE\": 1\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./AuthController.php",
    "groupTitle": "Auth_API_s"
  },
  {
    "type": "POST",
    "url": "/api/change_password",
    "title": "User change password",
    "name": "change_password",
    "group": "Auth_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "old_password",
            "description": "<p>Users old_password.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Users email.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>Users mobile_number.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Users Password.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>Users Password.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n \"STATUS_DESC\": \"Success\"\n \"STATUS_CODE\": 1\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./AuthController.php",
    "groupTitle": "Auth_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/get_airports_list",
    "title": "Airports List",
    "name": "Airports_List",
    "group": "FPL_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_DESC\": \"Success\"\n\t\"STATUS_CODE\": \"1\"\n\t\"result\":{\n\t\"STATUS_DESC\": \"success\",\n\t\"STATUS_CODE\": \"1\",\n\t\"result\": [\n\t{\n\t\"aero_id\": \"VIAX\",\n\t\"aero_name\": \"ADAMPUR\"\n\t},\n\t{\n\t\"aero_id\": \"VEAT\",\n\t\"aero_name\": \"AGARTALA\"\n\t},\n\t{\n\t\"aero_id\": \"VOAT\",\n\t\"aero_name\": \"AGATTI\"\n\t},\n\t{\n\t\"aero_id\": \"VIAG\",\n\t\"aero_name\": \"AGRA\"\n\t},\n\t{\n\t\"aero_id\": \"VAAH\",\n\t\"aero_name\": \"AHMEDABAD\"\n\t},\n\t{\n\t\"aero_id\": \"VELP\",\n\t\"aero_name\": \"AIZAWL\"\n\t},\n\t{\n\t\"aero_id\": \"VAAK\",\n\t\"aero_name\": \"AKOLA\"\n\t}]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "FPL_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/pdf_download/{id}",
    "title": "PDF download",
    "name": "PDF_download",
    "group": "FPL_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_DESC\": \"Success\"\n\t\"STATUS_CODE\": \"1\"\n\t\"result\":",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "FPL_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/pilots_list/{aircraft_callsign}",
    "title": "Pilots List",
    "name": "Pilots_List",
    "group": "FPL_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_DESC\": \"Success\"\n\t\"STATUS_CODE\": \"1\"\n\t\"result\":",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "FPL_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/stations_list",
    "title": "Station List",
    "name": "Station_List",
    "group": "FPL_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_CODE\": \"1\",\n\t\"STATUS_DESC\": \"success\",\n\t\"result\": [\n\t{\n\t\"aero_name\": \"ADAMPUR\",\n\t\"aero_latlong\": \"3126N07545E\"\n\t}\n\t]\n\t-\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "FPL_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fpl/edit_process",
    "title": "edit_process",
    "name": "edit_process",
    "group": "FPL_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>aircraft_callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>departure_aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>destination_aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time_hours",
            "description": "<p>departure_time_hours</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time_minutes",
            "description": "<p>departure_time_minutes</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pilot_in_command",
            "description": "<p>pilot_in_command</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>mobile_number</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "copilot",
            "description": "<p>copilot</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cabincrew",
            "description": "<p>cabincrew</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>date_of_flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_station",
            "description": "<p>departure_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_latlong",
            "description": "<p>departure_latlong</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_station",
            "description": "<p>destination_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_latlong",
            "description": "<p>destination_latlong</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "alternate_station",
            "description": "<p>alternate_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "endurance_hours",
            "description": "<p>endurance_hours</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "endurance_minutes",
            "description": "<p>endurance_minutes</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "indian",
            "description": "<p>indian</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "foreigner_nationality",
            "description": "<p>foreigner_nationality</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fir_crossing_time",
            "description": "<p>fir_crossing_time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "take_off_altn",
            "description": "<p>take_off_altn</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "route_altn",
            "description": "<p>route_altn</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "remarks",
            "description": "<p>remarks</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "route",
            "description": "<p>route</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "transponder",
            "description": "<p>transponder</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "equipment",
            "description": "<p>equipment</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_DESC\": \"Success\"\n\t\"STATUS_CODE\": \"1\"\n\t\"ATC_FPL_VIEW\": \"(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style=\"color:#f1292b\">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style=\"color:#f1292b\">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)\"\n\t\"SUPPLEMANTARY_INFO\": \"CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE\"\n\t\"IS_WATCH_HOUR_VALID\": 0\n\t\"DATA\": {\n\t\"customer_id\": null\n\t\"aircraft_callsign\": \"TESTA4\"\n\t\"flight_rules\": \"V\"\n\t\"flight_type\": \"G\"\n\t\"aircraft_type\": \"GFHF\"\n\t\"weight_category\": \"N\"\n\t\"equipment\": \"XCXXC\"\n\t\"transponder\": \"A\"\n\t\"departure_aerodrome\": \"VOMM\"\n\t\"departure_time_hours\": \"07\"\n\t\"departure_time_minutes\": \"45\"\n\t\"crushing_speed_indication\": \"K\"\n\t\"crushing_speed\": \"4444\"\n\t\"flight_level_indication\": \"F\"\n\t\"flight_level\": \"455\"\n\t\"route\": \"TEST ROUTE\"\n\t\"destination_aerodrome\": \"VOPC\"\n\t\"total_flying_hours\": \"03\"\n\t\"total_flying_minutes\": \"04\"\n\t\"first_alternate_aerodrome\": \"VOPG\"\n\t\"second_alternate_aerodrome\": \"VGGG\"\n\t\"departure_station\": \"\"\n\t\"departure_latlong\": \"\"\n\t\"destination_station\": \"\"\n\t\"destination_latlong\": \"\"\n\t\"alternate_station\": \"\"\n\t\"date_of_flight\": \"160414\"\n\t\"registration\": \"HGEGE\"\n\t\"endurance_hours\": \"00\"\n\t\"endurance_minutes\": \"09\"\n\t\"indian\": \"YES\"\n\t\"foreigner\": \"\"\n\t\"foreigner_nationality\": \"\"\n\t\"pilot_in_command\": \"ANAND\"\n\t\"mobile_number\": \"9889898989\"\n\t\"copilot\": \"TEST\"\n\t\"cabincrew\": \"TESTING\"\n\t\"operator\": \"ANAND\"\n\t\"sel\": \"NONE\"\n\t\"fir_crossing_time\": \"\"\n\t\"pbn\": \"PBNTEST\"\n\t\"nav\": \"NAVTEST\"\n\t\"code\": \"ABCDEF\"\n\t\"per\": \"C\"\n\t\"take_off_altn\": \"FFFF\"\n\t\"route_altn\": \"\"\n\t\"tcas\": \"\"\n\t\"credit\": \"\"\n\t\"no_credit\": \"\"\n\t\"remarks\": \"TEST REMARKS\"\n\t\"remarks1\": \"\"\n\t\"emergency_uhf\": \"YES\"\n\t\"emergency_vhf\": \"YES\"\n\t\"emergency_elba\": \"YES\"\n\t\"polar\": \"YES\"\n\t\"desert\": \"YES\"\n\t\"maritime\": \"YES\"\n\t\"jungle\": \"YES\"\n\t\"light\": \"YES\"\n\t\"floures\": \"YES\"\n\t\"jacket_uhf\": \"YES\"\n\t\"jacket_vhf\": \"YES\"\n\t\"number\": \"33\"\n\t\"capacity\": \"444\"\n\t\"cover\": \"YES\"\n\t\"color\": \"YELLOW\"\n\t\"aircraft_color\": \"BLUE\"\n\t\"fic\": \"\"\n\t\"adc\": \"\"\n\t\"india_time\": \"11:50:10\"\n\t\"plan_status\": 1\n\t\"filed_date\": \"<span style='color:#404040;'>02-Apr-2016</span>\"\n\t\"tbn\": \"TBN\"\n\t\"date\": \"\"\n\t\"signature\": \"\"\n\t\"remarks_value\": \"\"\n\t\"filing_time\": \"2016-04-02 11:50:10\"\n\t\"station_addresses_data\": \"<span>VOMMZTZX&nbsp;</span><span>VOMMZPZX&nbsp;</span><span>VOPCZTZX&nbsp;</span><span>VOMFZQZX&nbsp;</span><span></span><span></span><span></span>\"\n\t\"originator\": \"KINDXAAI\"\n\t\"is_watch_hour_valid\": 0\n\t\"entered_departure_time\": \"<span style=\"color:#f1292b\">VOMM0745</span>\"\n\t\"entered_destination_time\": \"<span style=\"color:#f1292b\">VOPC0304</span>\"\n\t\"fpl_info\": \"(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style=\"color:#f1292b\">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style=\"color:#f1292b\">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)\"\n\t\"supplementary_info\": \"CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE\"\n\t\"is_active\": 1\n\t\"filed_by\": \"<span style=color:#404040;>Anand</span>\"\n\t\"filed_time\": \"<span style='color:#404040;'>11:50:10 IST</span>\"\n\t\"filed_via\": \"<span style='margin-left:10px;color:#404040;'></span>Filed Via: privateflight.in\"\n\t\"subject_type\": \"fpl\"\n\t\"subject\": \"FPL TESTA4 VOMM 0745 - VOPC // 14-Apr-2016\"\n\t}-\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "FPL_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fpl/file_the_process",
    "title": "file_the_process",
    "name": "file_the_process",
    "group": "FPL_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>aircraft_callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>departure_aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>destination_aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time_hours",
            "description": "<p>departure_time_hours</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time_minutes",
            "description": "<p>departure_time_minutes</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pilot_in_command",
            "description": "<p>pilot_in_command</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>mobile_number</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "copilot",
            "description": "<p>copilot</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cabincrew",
            "description": "<p>cabincrew</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>date_of_flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_station",
            "description": "<p>departure_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_latlong",
            "description": "<p>departure_latlong</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_station",
            "description": "<p>destination_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_latlong",
            "description": "<p>destination_latlong</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "alternate_station",
            "description": "<p>alternate_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "registration",
            "description": "<p>registration</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "endurance_hours",
            "description": "<p>endurance_hours</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "endurance_minutes",
            "description": "<p>endurance_minutes</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "indian",
            "description": "<p>indian</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "foreigner",
            "description": "<p>foreigner</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "foreigner_nationality",
            "description": "<p>foreigner_nationality</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "operator",
            "description": "<p>operator</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "sel",
            "description": "<p>sel</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fir_crossing_time",
            "description": "<p>fir_crossing_time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pbn",
            "description": "<p>pbn</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nav",
            "description": "<p>nav</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>code</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "per",
            "description": "<p>per</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "take_off_altn",
            "description": "<p>take_off_altn</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "route_altn",
            "description": "<p>route_altn</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tcas",
            "description": "<p>tcas</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "credit",
            "description": "<p>credit</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "no_credit",
            "description": "<p>no_credit</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "remarks",
            "description": "<p>remarks</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emergency_uhf",
            "description": "<p>emergency_uhf</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emergency_vhf",
            "description": "<p>emergency_vhf</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "emergency_elba",
            "description": "<p>emergency_elba</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "polar",
            "description": "<p>polar</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "desert",
            "description": "<p>desert</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "maritime",
            "description": "<p>maritime</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "jungle",
            "description": "<p>jungle</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "light",
            "description": "<p>light</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "floures",
            "description": "<p>floures</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "jacket_uhf",
            "description": "<p>jacket_uhf</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "jacket_vhf",
            "description": "<p>jacket_vhf</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "number",
            "description": "<p>number</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "capacity",
            "description": "<p>capacity</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>cover</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "color",
            "description": "<p>color</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_color",
            "description": "<p>aircraft_color</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "tbn",
            "description": "<p>&quot;: &quot;TBN&quot;</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_DESC\": \"Success\"\n\t\"STATUS_CODE\": \"1\"\n\t\"ATC_FPL_VIEW\": \"(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style=\"color:#f1292b\">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style=\"color:#f1292b\">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)\"\n\t\"SUPPLEMANTARY_INFO\": \"CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE\"\n\t\"IS_WATCH_HOUR_VALID\": 0\n\t\"DATA\": {\n\t\"customer_id\": null\n\t\"aircraft_callsign\": \"TESTA4\"\n\t\"flight_rules\": \"V\"\n\t\"flight_type\": \"G\"\n\t\"aircraft_type\": \"GFHF\"\n\t\"weight_category\": \"N\"\n\t\"equipment\": \"XCXXC\"\n\t\"transponder\": \"A\"\n\t\"departure_aerodrome\": \"VOMM\"\n\t\"departure_time_hours\": \"07\"\n\t\"departure_time_minutes\": \"45\"\n\t\"crushing_speed_indication\": \"K\"\n\t\"crushing_speed\": \"4444\"\n\t\"flight_level_indication\": \"F\"\n\t\"flight_level\": \"455\"\n\t\"route\": \"TEST ROUTE\"\n\t\"destination_aerodrome\": \"VOPC\"\n\t\"total_flying_hours\": \"03\"\n\t\"total_flying_minutes\": \"04\"\n\t\"first_alternate_aerodrome\": \"VOPG\"\n\t\"second_alternate_aerodrome\": \"VGGG\"\n\t\"departure_station\": \"\"\n\t\"departure_latlong\": \"\"\n\t\"destination_station\": \"\"\n\t\"destination_latlong\": \"\"\n\t\"alternate_station\": \"\"\n\t\"date_of_flight\": \"160414\"\n\t\"registration\": \"HGEGE\"\n\t\"endurance_hours\": \"00\"\n\t\"endurance_minutes\": \"09\"\n\t\"indian\": \"YES\"\n\t\"foreigner\": \"\"\n\t\"foreigner_nationality\": \"\"\n\t\"pilot_in_command\": \"ANAND\"\n\t\"mobile_number\": \"9889898989\"\n\t\"copilot\": \"TEST\"\n\t\"cabincrew\": \"TESTING\"\n\t\"operator\": \"ANAND\"\n\t\"sel\": \"NONE\"\n\t\"fir_crossing_time\": \"\"\n\t\"pbn\": \"PBNTEST\"\n\t\"nav\": \"NAVTEST\"\n\t\"code\": \"ABCDEF\"\n\t\"per\": \"C\"\n\t\"take_off_altn\": \"FFFF\"\n\t\"route_altn\": \"\"\n\t\"tcas\": \"\"\n\t\"credit\": \"\"\n\t\"no_credit\": \"\"\n\t\"remarks\": \"TEST REMARKS\"\n\t\"remarks1\": \"\"\n\t\"emergency_uhf\": \"YES\"\n\t\"emergency_vhf\": \"YES\"\n\t\"emergency_elba\": \"YES\"\n\t\"polar\": \"YES\"\n\t\"desert\": \"YES\"\n\t\"maritime\": \"YES\"\n\t\"jungle\": \"YES\"\n\t\"light\": \"YES\"\n\t\"floures\": \"YES\"\n\t\"jacket_uhf\": \"YES\"\n\t\"jacket_vhf\": \"YES\"\n\t\"number\": \"33\"\n\t\"capacity\": \"444\"\n\t\"cover\": \"YES\"\n\t\"color\": \"YELLOW\"\n\t\"aircraft_color\": \"BLUE\"\n\t\"fic\": \"\"\n\t\"adc\": \"\"\n\t\"india_time\": \"11:50:10\"\n\t\"plan_status\": 1\n\t\"filed_date\": \"<span style='color:#404040;'>02-Apr-2016</span>\"\n\t\"tbn\": \"TBN\"\n\t\"date\": \"\"\n\t\"signature\": \"\"\n\t\"remarks_value\": \"\"\n\t\"filing_time\": \"2016-04-02 11:50:10\"\n\t\"station_addresses_data\": \"<span>VOMMZTZX&nbsp;</span><span>VOMMZPZX&nbsp;</span><span>VOPCZTZX&nbsp;</span><span>VOMFZQZX&nbsp;</span><span></span><span></span><span></span>\"\n\t\"originator\": \"KINDXAAI\"\n\t\"is_watch_hour_valid\": 0\n\t\"entered_departure_time\": \"<span style=\"color:#f1292b\">VOMM0745</span>\"\n\t\"entered_destination_time\": \"<span style=\"color:#f1292b\">VOPC0304</span>\"\n\t\"fpl_info\": \"(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style=\"color:#f1292b\">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style=\"color:#f1292b\">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)\"\n\t\"supplementary_info\": \"CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE\"\n\t\"is_active\": 1\n\t\"filed_by\": \"<span style=color:#404040;>Anand</span>\"\n\t\"filed_time\": \"<span style='color:#404040;'>11:50:10 IST</span>\"\n\t\"filed_via\": \"<span style='margin-left:10px;color:#404040;'></span>Filed Via: privateflight.in\"\n\t\"subject_type\": \"fpl\"\n\t\"subject\": \"FPL TESTA4 VOMM 0745 - VOPC // 14-Apr-2016\"\n\t}-\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "FPL_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fpl/process_quick_plan",
    "title": "process_quick_plan",
    "name": "process_quick_plan",
    "group": "FPL_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>aircraft_callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>departure_aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>destination_aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time_hours",
            "description": "<p>departure_time_hours</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time_minutes",
            "description": "<p>departure_time_minutes</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pilot_in_command",
            "description": "<p>pilot_in_command</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>mobile_number</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "copilot",
            "description": "<p>copilot</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cabincrew",
            "description": "<p>cabincrew</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>date_of_flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_station",
            "description": "<p>departure_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_latlong",
            "description": "<p>departure_latlong</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_station",
            "description": "<p>destination_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_latlong",
            "description": "<p>destination_latlong</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_DESC\": \"Success\"\n\t\"STATUS_CODE\": \"1\"\n\t\"ATC_FPL_VIEW\": \"(FPL-TESTA-VG<br>-GFHF/N-XCXXC/A<br>-0745<br>-K4444F455 fcgbfdgdg<br>-1049 VOPG VGGG<br>-DOF/160412 REG/HGEGE OPR/ANAND TALT/FFFF <br>RMK/dfgdfg NO CREDIT FACILITY PIC ANAND MOB 2147483647 ALL INDIANS ON BOARD E0009)\"\n\t\"SUPPLEMANTARY_INFO\": \"CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO:<br>SURVIVAL EQUIPMENT:<br>JACKETS:<br> <span style='padding-left:0px;'></span>DINGHIES COLOUR: <br>AIRCRAFT COLOUR & MARKINGS: BLUE\"\n\t\"IS_WATCH_HOUR_VALID\": 0\n\t\"DATA\": {\n\t\"customer_id\": null\n\t\"aircraft_callsign\": \"TESTA\"\n\t\"flight_rules\": \"V\"\n\t\"flight_type\": \"G\"\n\t\"aircraft_type\": \"GFHF\"\n\t\"weight_category\": \"N\"\n\t\"equipment\": \"XCXXC\"\n\t\"transponder\": \"A\"\n\t\"departure_aerodrome\": \"VOBG\"\n\t\"departure_time_hours\": \"07\"\n\t\"departure_time_minutes\": \"45\"\n\t\"crushing_speed_indication\": \"K\"\n\t\"crushing_speed\": \"4444\"\n\t\"flight_level_indication\": \"F\"\n\t\"flight_level\": \"455\"\n\t\"route\": \"fcgbfdgdg\"\n\t\"destination_aerodrome\": \"VOPC\"\n\t\"total_flying_hours\": \"03\"\n\t\"total_flying_minutes\": \"04\"\n\t\"first_alternate_aerodrome\": \"VOPG\"\n\t\"second_alternate_aerodrome\": \"VGGG\"\n\t\"departure_station\": null\n\t\"departure_latlong\": null\n\t\"destination_station\": null\n\t\"destination_latlong\": null\n\t\"alternate_station\": \"\"\n\t\"date_of_flight\": \"160412\"\n\t\"registration\": \"HGEGE\"\n\t\"endurance_hours\": \"00\"\n\t\"endurance_minutes\": \"09\"\n\t\"indian\": \"YES\"\n\t\"foreigner\": \"\"\n\t\"foreigner_nationality\": \"\"\n\t\"pilot_in_command\": \"ANAND\"\n\t\"mobile_number\": 2147483647\n\t\"copilot\": \"TEST\"\n\t\"cabincrew\": \"TESTING\"\n\t\"operator\": \"ANAND\"\n\t\"sel\": \"\"\n\t\"fir_crossing_time\": \"\"\n\t\"pbn\": \"\"\n\t\"nav\": \"\"\n\t\"code\": \"\"\n\t\"per\": \"\"\n\t\"take_off_altn\": \"FFFF\"\n\t\"route_altn\": \"\"\n\t\"tcas\": \"\"\n\t\"credit\": \"\"\n\t\"no_credit\": \"\"\n\t\"remarks\": \"dfgdfg\"\n\t\"remarks1\": \"\"\n\t\"emergency_uhf\": \"\"\n\t\"emergency_vhf\": \"\"\n\t\"emergency_elba\": \"\"\n\t\"polar\": \"\"\n\t\"desert\": \"\"\n\t\"maritime\": \"\"\n\t\"jungle\": \"\"\n\t\"light\": \"\"\n\t\"floures\": \"\"\n\t\"jacket_uhf\": \"\"\n\t\"jacket_vhf\": \"\"\n\t\"number\": \"\"\n\t\"capacity\": \"\"\n\t\"cover\": \"\"\n\t\"color\": \"\"\n\t\"aircraft_color\": \"BLUE\"\n\t\"fic\": \"\"\n\t\"adc\": \"\"\n\t\"india_time\": \"15:56:11\"\n\t\"plan_status\": 1\n\t\"filed_date\": \"2016-04-01 15:56:11\"\n\t\"is_watch_hour_valid\": 0\n\t\"entered_departure_time\": \"0745\"\n\t\"entered_destination_time\": 1049\n\t\"fpl_info\": \"(FPL-TESTA-VG<br>-GFHF/N-XCXXC/A<br>-0745<br>-K4444F455 fcgbfdgdg<br>-1049 VOPG VGGG<br>-DOF/160412 REG/HGEGE OPR/ANAND TALT/FFFF <br>RMK/dfgdfg NO CREDIT FACILITY PIC ANAND MOB 2147483647 ALL INDIANS ON BOARD E0009)\"\n\t\"supplementary_info\": \"CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO:<br>SURVIVAL EQUIPMENT:<br>JACKETS:<br> <span style='padding-left:0px;'></span>DINGHIES COLOUR: <br>AIRCRAFT COLOUR & MARKINGS: BLUE\"\n\t\"is_process\": 1\n\t}-\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "FPL_API_s"
  },
  {
    "type": "POST",
    "url": "/api/home/contact-us",
    "title": "User Contact Form",
    "name": "Contact_us",
    "group": "Home_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Users name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Users email.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>Users mobile_number.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "operator",
            "description": "<p>Company Name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Comments.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n \"STATUS_DESC\": \"Success\"\n \"STATUS_CODE\": 1\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Home/HomeController.php",
    "groupTitle": "Home_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fpl/fpl_cancel/{id}",
    "title": "Cancel Plan",
    "name": "Cancel_Plan",
    "group": "My_Account_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_CODE\": \"1\",\n\t\"STATUS_DESC\": \"success\",\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/get_count_fpl",
    "title": "Count of FPL",
    "name": "Count_of_FPL",
    "group": "My_Account_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\n\t{\n\t\"STATUS_CODE\": 1\n\t\"STATUS_DESC\": \"Success\"\n\t\"result\":{\"day_count\":4,\"month_count\":33,\"total_count\":74}\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/get_fpl_list?email=anand.vuppu@pravahya.com&page=2",
    "title": "FPL List",
    "name": "FPL_List",
    "group": "My_Account_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "page",
            "description": "<p>page No</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_CODE\": \"1\",\n\t\"STATUS_DESC\": \"success\",\n\t{\n\t\"STATUS_CODE\": 0\n\t\"STATUS_DESC\": \"Success\"\n\t\"result\": [1]\n\t0:  {\n\t\"id\": 29711\n\t\"user_id\": \"26\"\n\t\"aircraft_callsign\": \"TESTA\"\n\t\"departure_aerodrome\": \"VOBG\"\n\t\"destination_aerodrome\": \"VOPC\"\n\t\"departure_time_hours\": \"16\"\n\t\"departure_time_minutes\": \"30\"\n\t\"date_of_flight\": 160413\n\t\"departure_station\": \"\"\n\t\"destination_station\": \"\"\n\t\"pilot_in_command\": \"ANAND\"\n\t\"mobile_number\": 2147483647\n\t\"copilot\": \"TEST\"\n\t\"cabincrew\": \"TESTING\"\n\t\"operator\": \"ANAND\"\n\t\"departure_latlong\": \"\"\n\t\"destination_latlong\": \"\"\n\t\"flight_rules\": \"V\"\n\t\"flight_type\": \"G\"\n\t\"aircraft_type\": \"GFHF\"\n\t\"weight_category\": \"N\"\n\t\"equipment\": \"XCXXC\"\n\t\"transponder\": \"A\"\n\t\"crushing_speed_indication\": \"K\"\n\t\"crushing_speed\": \"4444\"\n\t\"flight_level_indication\": \"F\"\n\t\"flight_level\": \"455\"\n\t\"route\": \"FCGBFDGDG \"\n\t\"total_flying_hours\": \"03\"\n\t\"total_flying_minutes\": \"04\"\n\t\"first_alternate_aerodrome\": \"VOPG\"\n\t\"second_alternate_aerodrome\": \"VGGG\"\n\t\"alternate_station\": \"\"\n\t\"registration\": \"HGEGE\"\n\t\"endurance_hours\": \"00\"\n\t\"endurance_minutes\": \"09\"\n\t\"indian\": \"YES\"\n\t\"foreigner\": \"NO\"\n\t\"foreigner_nationality\": \"\"\n\t\"sel\": \"ERTE\"\n\t\"fir_crossing_time\": \"\"\n\t\"pbn\": \"\"\n\t\"nav\": \"\"\n\t\"code\": \"DRTGDR\"\n\t\"per\": \"D\"\n\t\"take_off_altn\": \"FFFF\"\n\t\"route_altn\": \"DFGD\"\n\t\"tcas\": \"YES\"\n\t\"credit\": \"YES\"\n\t\"no_credit\": \"NO\"\n\t\"remarks\": \"DFGDFG \"\n\t\"emergency_uhf\": \"YES\"\n\t\"emergency_vhf\": \"YES\"\n\t\"emergency_elba\": \"YES\"\n\t\"polar\": \"YES\"\n\t\"desert\": \"YES\"\n\t\"maritime\": \"YES\"\n\t\"jungle\": \"YES\"\n\t\"light\": \"YES\"\n\t\"floures\": \"YES\"\n\t\"jacket_uhf\": \"YES\"\n\t\"jacket_vhf\": \"YES\"\n\t\"number\": \"34\"\n\t\"capacity\": \"454\"\n\t\"cover\": \"NO\"\n\t\"color\": \"FGSDGDSG\"\n\t\"aircraft_color\": \"BLUEDFGDFG\"\n\t\"fic\": \"\"\n\t\"adc\": \"\"\n\t\"india_time\": \"16:47:49\"\n\t\"plan_status\": \"1\"\n\t\"filed_date\": \"2016-04-13 16:47:49\"\n\t\"is_active\": 1\n\t\"created_at\": \"2016-04-13 16:42:11\"\n\t\"updated_at\": \"2016-04-13 16:47:55\"\n\t}-\n\t-\n\t}\n\t-\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/get_fpl_record/{id}",
    "title": "get fpl record",
    "name": "Get_Fpl_Record",
    "group": "My_Account_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\n\t{\n\t\"STATUS_CODE\": 1\n\t\"STATUS_DESC\": \"Success\"\n\t\"result\": {\n\t\"id\": 29735\n\t\"user_id\": 89\n\t\"aircraft_callsign\": \"TESTA\"\n\t\"departure_aerodrome\": \"VOBG\"\n\t\"destination_aerodrome\": \"VOPC\"\n\t\"departure_time_hours\": \"07\"\n\t\"departure_time_minutes\": \"45\"\n\t\"date_of_flight\": \"160520\"\n\t\"departure_station\": null\n\t\"destination_station\": null\n\t\"pilot_in_command\": \"ANAND\"\n\t\"mobile_number\": 2147483647\n\t\"copilot\": \"TEST\"\n\t\"cabincrew\": \"TESTING\"\n\t\"operator\": \"ANAND\"\n\t\"departure_latlong\": null\n\t\"destination_latlong\": null\n\t\"flight_rules\": \"\"\n\t\"flight_type\": \"G\"\n\t\"aircraft_type\": \"GFHF\"\n\t\"weight_category\": \"N\"\n\t\"equipment\": \"XCXXC\"\n\t\"transponder\": \"H\"\n\t\"crushing_speed_indication\": \"K\"\n\t\"crushing_speed\": \"4444\"\n\t\"flight_level_indication\": \"F\"\n\t\"flight_level\": \"455\"\n\t\"route\": \"FCGBFDGDG\"\n\t\"total_flying_hours\": \"03\"\n\t\"total_flying_minutes\": \"04\"\n\t\"first_alternate_aerodrome\": \"VOPG\"\n\t\"second_alternate_aerodrome\": \"VGGG\"\n\t\"alternate_station\": \"\"\n\t\"registration\": \"HGEGE\"\n\t\"endurance_hours\": \"00\"\n\t\"endurance_minutes\": \"09\"\n\t\"indian\": \"NO\"\n\t\"foreigner\": \"NO\"\n\t\"foreigner_nationality\": \"\"\n\t\"sel\": \"NONE\"\n\t\"fir_crossing_time\": null\n\t\"pbn\": \"\"\n\t\"nav\": \"\"\n\t\"code\": \"ABCDEF\"\n\t\"per\": \"C\"\n\t\"take_off_altn\": \"FFFF\"\n\t\"route_altn\": \"\"\n\t\"tcas\": \"NO\"\n\t\"credit\": \"YES\"\n\t\"no_credit\": \"NO\"\n\t\"remarks\": \"DFGDFG\"\n\t\"emergency_uhf\": \"YES\"\n\t\"emergency_vhf\": \"YES\"\n\t\"emergency_elba\": \"NO\"\n\t\"polar\": \"NO\"\n\t\"desert\": \"YES\"\n\t\"maritime\": \"YES\"\n\t\"jungle\": \"YES\"\n\t\"light\": \"NO\"\n\t\"floures\": \"YES\"\n\t\"jacket_uhf\": \"YES\"\n\t\"jacket_vhf\": \"YES\"\n\t\"number\": \"34\"\n\t\"capacity\": \"45\"\n\t\"cover\": \"YES\"\n\t\"color\": \"GFGFG\"\n\t\"aircraft_color\": \"WHITE\"\n\t\"fic\": \"\"\n\t\"adc\": \"\"\n\t\"india_time\": \"14:53:16\"\n\t\"plan_status\": \"1\"\n\t\"filed_date\": \"2016-05-18 14:53:16\"\n\t\"is_active\": 1\n\t\"is_delete\": 0\n\t\"is_app\": 0\n\t\"is_old_record\": 0\n\t\"updated_by\": 0\n\t\"adc_updated_by\": 0\n\t\"adc_updated_time\": \"0000-00-00 00:00:00\"\n\t\"created_at\": \"2016-04-22 16:35:04\"\n\t\"updated_at\": \"2016-05-18 14:53:16\"\n\t}-\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/pdf_download/{id}",
    "title": "PDF download",
    "name": "PDF_download",
    "group": "My_Account_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_DESC\": \"Success\"\n\t\"STATUS_CODE\": \"1\"\n\t\"result\":",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/fpl_atc_info/{id}?email=anand.vuppu@pravahya.com",
    "title": "Preview of Plan",
    "name": "Preview_of_Plan",
    "group": "My_Account_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_CODE\": \"1\",\n\t\"STATUS_DESC\": \"success\",\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fpl/revise_time/{id}",
    "title": "Revise Departure Time",
    "name": "Revise_Departure_Time",
    "group": "My_Account_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time",
            "description": "<p>departure_time</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_CODE\": \"1\",\n\t\"STATUS_DESC\": \"success\",\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fpl/change_fpl/{id}",
    "title": "change_fpl",
    "name": "change_fpl",
    "group": "My_Account_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>aircraft_callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>departure_aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>destination_aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time_hours",
            "description": "<p>departure_time_hours</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time_minutes",
            "description": "<p>departure_time_minutes</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pilot_in_command",
            "description": "<p>pilot_in_command</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "mobile_number",
            "description": "<p>mobile_number</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "copilot",
            "description": "<p>copilot</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cabincrew",
            "description": "<p>cabincrew</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>date_of_flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_station",
            "description": "<p>departure_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_latlong",
            "description": "<p>departure_latlong</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_station",
            "description": "<p>destination_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_latlong",
            "description": "<p>destination_latlong</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "alternate_station",
            "description": "<p>alternate_station</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "endurance_hours",
            "description": "<p>endurance_hours</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "endurance_minutes",
            "description": "<p>endurance_minutes</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "indian",
            "description": "<p>indian</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "foreigner_nationality",
            "description": "<p>foreigner_nationality</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "fir_crossing_time",
            "description": "<p>fir_crossing_time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "take_off_altn",
            "description": "<p>take_off_altn</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "route_altn",
            "description": "<p>route_altn</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "remarks",
            "description": "<p>remarks</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "route",
            "description": "<p>route</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pbn",
            "description": "<p>pbn</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nav",
            "description": "<p>nav</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "flight_rules",
            "description": "<p>flight_rules</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "transponder",
            "description": "<p>transponder</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "equipment",
            "description": "<p>equipment</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t\"STATUS_DESC\": \"Success\"\n\t\"STATUS_CODE\": \"1\"\n\t\"ATC_FPL_VIEW\": \"(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style=\"color:#f1292b\">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style=\"color:#f1292b\">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)\"\n\t\"SUPPLEMANTARY_INFO\": \"CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE\"\n\t\"IS_WATCH_HOUR_VALID\": 0\n\t\"DATA\": {\n\t\"customer_id\": null\n\t\"aircraft_callsign\": \"TESTA4\"\n\t\"flight_rules\": \"V\"\n\t\"flight_type\": \"G\"\n\t\"aircraft_type\": \"GFHF\"\n\t\"weight_category\": \"N\"\n\t\"equipment\": \"XCXXC\"\n\t\"transponder\": \"A\"\n\t\"departure_aerodrome\": \"VOMM\"\n\t\"departure_time_hours\": \"07\"\n\t\"departure_time_minutes\": \"45\"\n\t\"crushing_speed_indication\": \"K\"\n\t\"crushing_speed\": \"4444\"\n\t\"flight_level_indication\": \"F\"\n\t\"flight_level\": \"455\"\n\t\"route\": \"TEST ROUTE\"\n\t\"destination_aerodrome\": \"VOPC\"\n\t\"total_flying_hours\": \"03\"\n\t\"total_flying_minutes\": \"04\"\n\t\"first_alternate_aerodrome\": \"VOPG\"\n\t\"second_alternate_aerodrome\": \"VGGG\"\n\t\"departure_station\": \"\"\n\t\"departure_latlong\": \"\"\n\t\"destination_station\": \"\"\n\t\"destination_latlong\": \"\"\n\t\"alternate_station\": \"\"\n\t\"date_of_flight\": \"160414\"\n\t\"registration\": \"HGEGE\"\n\t\"endurance_hours\": \"00\"\n\t\"endurance_minutes\": \"09\"\n\t\"indian\": \"YES\"\n\t\"foreigner\": \"\"\n\t\"foreigner_nationality\": \"\"\n\t\"pilot_in_command\": \"ANAND\"\n\t\"mobile_number\": \"9889898989\"\n\t\"copilot\": \"TEST\"\n\t\"cabincrew\": \"TESTING\"\n\t\"operator\": \"ANAND\"\n\t\"sel\": \"NONE\"\n\t\"fir_crossing_time\": \"\"\n\t\"pbn\": \"PBNTEST\"\n\t\"nav\": \"NAVTEST\"\n\t\"code\": \"ABCDEF\"\n\t\"per\": \"C\"\n\t\"take_off_altn\": \"FFFF\"\n\t\"route_altn\": \"\"\n\t\"tcas\": \"\"\n\t\"credit\": \"\"\n\t\"no_credit\": \"\"\n\t\"remarks\": \"TEST REMARKS\"\n\t\"remarks1\": \"\"\n\t\"emergency_uhf\": \"YES\"\n\t\"emergency_vhf\": \"YES\"\n\t\"emergency_elba\": \"YES\"\n\t\"polar\": \"YES\"\n\t\"desert\": \"YES\"\n\t\"maritime\": \"YES\"\n\t\"jungle\": \"YES\"\n\t\"light\": \"YES\"\n\t\"floures\": \"YES\"\n\t\"jacket_uhf\": \"YES\"\n\t\"jacket_vhf\": \"YES\"\n\t\"number\": \"33\"\n\t\"capacity\": \"444\"\n\t\"cover\": \"YES\"\n\t\"color\": \"YELLOW\"\n\t\"aircraft_color\": \"BLUE\"\n\t\"fic\": \"\"\n\t\"adc\": \"\"\n\t\"india_time\": \"11:50:10\"\n\t\"plan_status\": 1\n\t\"filed_date\": \"<span style='color:#404040;'>02-Apr-2016</span>\"\n\t\"tbn\": \"TBN\"\n\t\"date\": \"\"\n\t\"signature\": \"\"\n\t\"remarks_value\": \"\"\n\t\"filing_time\": \"2016-04-02 11:50:10\"\n\t\"station_addresses_data\": \"<span>VOMMZTZX&nbsp;</span><span>VOMMZPZX&nbsp;</span><span>VOPCZTZX&nbsp;</span><span>VOMFZQZX&nbsp;</span><span></span><span></span><span></span>\"\n\t\"originator\": \"KINDXAAI\"\n\t\"is_watch_hour_valid\": 0\n\t\"entered_departure_time\": \"<span style=\"color:#f1292b\">VOMM0745</span>\"\n\t\"entered_destination_time\": \"<span style=\"color:#f1292b\">VOPC0304</span>\"\n\t\"fpl_info\": \"(FPL-TESTA4-VG<br>-GFHF/N-XCXXC/A<br>-<span style=\"color:#f1292b\">VOMM0745</span><br>-K4444F455 TEST ROUTE<br>-<span style=\"color:#f1292b\">VOPC0304</span> VOPG VGGG<br>-PBN/PBNTEST NAV/NAVTEST DOF/160414 REG/HGEGE CODE/ABCDEF SEL/NONE OPR/ANAND PER/C TALT/FFFF <br>RMK/TEST REMARKS NO CREDIT FACILITY PIC ANAND MOB 9889898989 ALL INDIANS ON BOARD E0009)\"\n\t\"supplementary_info\": \"CO PILOT: TEST<br>CABIN CREW: TESTING<br>EMERGENCY RADIO: UHF, VHF, ELBA<br>SURVIVAL EQUIPMENT: POLAR, DESERT, MARITIME, JUNGLE<br>JACKETS: UHF, VHF, LIGHT,FLUORES<br>DINGHIES: 33 <span style='padding-left:10px'>CAPACITY:</span> 444<br>COVER: YES <span style='padding-left:15px;'></span>DINGHIES COLOUR: YELLOW<br>AIRCRAFT COLOUR & MARKINGS: BLUE\"\n\t\"is_active\": 1\n\t\"filed_by\": \"<span style=color:#404040;>Anand</span>\"\n\t\"filed_time\": \"<span style='color:#404040;'>11:50:10 IST</span>\"\n\t\"filed_via\": \"<span style='margin-left:10px;color:#404040;'></span>Filed Via: privateflight.in\"\n\t\"subject_type\": \"fpl\"\n\t\"subject\": \"FPL TESTA4 VOMM 0745 - VOPC // 14-Apr-2016\"\n\t}-\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"not_found\": true\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/get_dep_zzzz_name/id/29712/email/anand.vuppu@pravahya.com",
    "title": "get_dep_zzzz_name",
    "name": "get_dep_zzzz_name",
    "group": "My_Account_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t{\n\t\"STATUS_CODE\": 0\n\t\"STATUS_DESC\": \"success\"\n\t\"departure_station\": \"AHMEDABAD\"\n\t}\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n    {\n\t\"STATUS_CODE\": 0\n\t\"STATUS_DESC\": \"Not Found\"\n\t\"departure_station\": \"\"\n\t}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "type": "GET",
    "url": "/api/fpl/get_dest_zzzz_name/id/29712/email/anand.vuppu@pravahya.com",
    "title": "get_dest_zzzz_name",
    "name": "get_dest_zzzz_name",
    "group": "My_Account_API_s",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_DESC",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_CODE",
            "description": "<p>1 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "     HTTP/1.1 200 OK\n\t{\n\t{\n\t\"STATUS_CODE\": 0\n\t\"STATUS_DESC\": \"success\"\n\t\"destination_station\": \"AHMEDABAD\"\n\t}\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 404 Not Found\n    {\n\t\"STATUS_CODE\": 0\n\t\"STATUS_DESC\": \"Not Found\"\n\t\"destination_station\": \"\"\n\t}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fpl/fplControllerAPI.php",
    "groupTitle": "My_Account_API_s"
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./doc/main.js",
    "group": "c__xampp_htdocs_pvtflightnew_app_Api_Controllers_doc_main_js",
    "groupTitle": "c__xampp_htdocs_pvtflightnew_app_Api_Controllers_doc_main_js",
    "name": ""
  },
  {
    "type": "POST",
    "url": "/api/fdtl/fdtl_store_fifth_landing/{id}",
    "title": "Fifth Landing",
    "name": "Fifth_Landing",
    "group": "fdtl_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>Aircraft Callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>Departure Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>Destination Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>Date Of Flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time",
            "description": "<p>Departure Time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "total_flying_time",
            "description": "<p>Total Flying Time</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_MESSAGE",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS",
            "description": "<p>200 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n\"STATUS\": \"200\",\n\"STATUS_MESSAGE\": \"Success\",\n\"data\": {\n\"reporting_time\": \"0515 GMT (1045 IST)\",\n\"chocks_off\": \"0555 GMT (1125 IST)\",\n\"chocks_on\": \"1005 GMT (1535 IST)\",\n\"duty_end_time\": \"1020 GMT (1550 IST)\",\n\"flight_time\": \"04 Hours 10 Minutes \",\n\"flight_duty_period\": \"05 Hours 05 Minutes \",\n\"split_duty\": \"NOT APPLICABLE\",\n\"split_duty_condition_value\": \"0\",\n\"total_FT\": \"04 Hours 10 Minutes \",\n\"total_FT_condition_value\": \"0\",\n\"total_fdp\": \"05 Hours 05 Minutes \",\n\"total_fdp_condition_value\": \"0\",\n\"last_dep_time\": \"21:05 (WITHOUT SPLIT DUTY)\",\n\"last_arrival_time\": \"22:45 (WITHOUT SPLIT DUTY)\",\n\"next_day_take_off\": \"00:50 GMT (0620 IST)\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\n{\n  \"STATUS\" => \"404\",\n  \"STATUS_MESSAGE\": \"Not Found\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fdtl/FdtlControllerAPI.php",
    "groupTitle": "fdtl_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fdtl/fdtl_store_first_landing/{id}",
    "title": "First Landing",
    "name": "First_Landing",
    "group": "fdtl_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>Aircraft Callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>Departure Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>Destination Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>Date Of Flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time",
            "description": "<p>Departure Time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "total_flying_time",
            "description": "<p>Total Flying Time</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_MESSAGE",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS",
            "description": "<p>200 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n\"STATUS\": \"200\",\n\"STATUS_MESSAGE\": \"Success\",\n\"data\": {\n\"reporting_time\": \"0515 GMT (1045 IST)\",\n\"chocks_off\": \"0555 GMT (1125 IST)\",\n\"chocks_on\": \"1005 GMT (1535 IST)\",\n\"duty_end_time\": \"1020 GMT (1550 IST)\",\n\"flight_time\": \"04 Hours 10 Minutes \",\n\"flight_duty_period\": \"05 Hours 05 Minutes \",\n\"split_duty\": \"NOT APPLICABLE\",\n\"split_duty_condition_value\": \"0\",\n\"total_FT\": \"04 Hours 10 Minutes \",\n\"total_FT_condition_value\": \"0\",\n\"total_fdp\": \"05 Hours 05 Minutes \",\n\"total_fdp_condition_value\": \"0\",\n\"last_dep_time\": \"21:05 (WITHOUT SPLIT DUTY)\",\n\"last_arrival_time\": \"22:45 (WITHOUT SPLIT DUTY)\",\n\"next_day_take_off\": \"00:50 GMT (0620 IST)\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\n{\n  \"STATUS\" => \"404\",\n  \"STATUS_MESSAGE\": \"Not Found\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fdtl/FdtlControllerAPI.php",
    "groupTitle": "fdtl_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fdtl/fdtl_store_fourth_landing/{id}",
    "title": "Fourth Landing",
    "name": "Fourth_Landing",
    "group": "fdtl_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>Aircraft Callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>Departure Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>Destination Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>Date Of Flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time",
            "description": "<p>Departure Time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "total_flying_time",
            "description": "<p>Total Flying Time</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_MESSAGE",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS",
            "description": "<p>200 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n\"STATUS\": \"200\",\n\"STATUS_MESSAGE\": \"Success\",\n\"data\": {\n\"reporting_time\": \"0515 GMT (1045 IST)\",\n\"chocks_off\": \"0555 GMT (1125 IST)\",\n\"chocks_on\": \"1005 GMT (1535 IST)\",\n\"duty_end_time\": \"1020 GMT (1550 IST)\",\n\"flight_time\": \"04 Hours 10 Minutes \",\n\"flight_duty_period\": \"05 Hours 05 Minutes \",\n\"split_duty\": \"NOT APPLICABLE\",\n\"split_duty_condition_value\": \"0\",\n\"total_FT\": \"04 Hours 10 Minutes \",\n\"total_FT_condition_value\": \"0\",\n\"total_fdp\": \"05 Hours 05 Minutes \",\n\"total_fdp_condition_value\": \"0\",\n\"last_dep_time\": \"21:05 (WITHOUT SPLIT DUTY)\",\n\"last_arrival_time\": \"22:45 (WITHOUT SPLIT DUTY)\",\n\"next_day_take_off\": \"00:50 GMT (0620 IST)\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\n{\n  \"STATUS\" => \"404\",\n  \"STATUS_MESSAGE\": \"Not Found\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fdtl/FdtlControllerAPI.php",
    "groupTitle": "fdtl_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fdtl/fdtl_store_second_landing/{id}",
    "title": "Second Landing",
    "name": "Second_Landing",
    "group": "fdtl_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>Aircraft Callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>Departure Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>Destination Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>Date Of Flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time",
            "description": "<p>Departure Time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "total_flying_time",
            "description": "<p>Total Flying Time</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_MESSAGE",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS",
            "description": "<p>200 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n\"STATUS\": \"200\",\n\"STATUS_MESSAGE\": \"Success\",\n\"data\": {\n\"reporting_time\": \"0515 GMT (1045 IST)\",\n\"chocks_off\": \"0555 GMT (1125 IST)\",\n\"chocks_on\": \"1005 GMT (1535 IST)\",\n\"duty_end_time\": \"1020 GMT (1550 IST)\",\n\"flight_time\": \"04 Hours 10 Minutes \",\n\"flight_duty_period\": \"05 Hours 05 Minutes \",\n\"split_duty\": \"NOT APPLICABLE\",\n\"split_duty_condition_value\": \"0\",\n\"total_FT\": \"04 Hours 10 Minutes \",\n\"total_FT_condition_value\": \"0\",\n\"total_fdp\": \"05 Hours 05 Minutes \",\n\"total_fdp_condition_value\": \"0\",\n\"last_dep_time\": \"21:05 (WITHOUT SPLIT DUTY)\",\n\"last_arrival_time\": \"22:45 (WITHOUT SPLIT DUTY)\",\n\"next_day_take_off\": \"00:50 GMT (0620 IST)\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\n{\n  \"STATUS\" => \"404\",\n  \"STATUS_MESSAGE\": \"Not Found\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fdtl/FdtlControllerAPI.php",
    "groupTitle": "fdtl_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fdtl/fdtl_store_sixth_landing/{id}",
    "title": "Sixth Landing",
    "name": "Sixth_Landing",
    "group": "fdtl_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>Aircraft Callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>Departure Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>Destination Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>Date Of Flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time",
            "description": "<p>Departure Time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "total_flying_time",
            "description": "<p>Total Flying Time</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_MESSAGE",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS",
            "description": "<p>200 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n\"STATUS\": \"200\",\n\"STATUS_MESSAGE\": \"Success\",\n\"data\": {\n\"reporting_time\": \"0515 GMT (1045 IST)\",\n\"chocks_off\": \"0555 GMT (1125 IST)\",\n\"chocks_on\": \"1005 GMT (1535 IST)\",\n\"duty_end_time\": \"1020 GMT (1550 IST)\",\n\"flight_time\": \"04 Hours 10 Minutes \",\n\"flight_duty_period\": \"05 Hours 05 Minutes \",\n\"split_duty\": \"NOT APPLICABLE\",\n\"split_duty_condition_value\": \"0\",\n\"total_FT\": \"04 Hours 10 Minutes \",\n\"total_FT_condition_value\": \"0\",\n\"total_fdp\": \"05 Hours 05 Minutes \",\n\"total_fdp_condition_value\": \"0\",\n\"last_dep_time\": \"21:05 (WITHOUT SPLIT DUTY)\",\n\"last_arrival_time\": \"22:45 (WITHOUT SPLIT DUTY)\",\n\"next_day_take_off\": \"00:50 GMT (0620 IST)\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\n{\n  \"STATUS\" => \"404\",\n  \"STATUS_MESSAGE\": \"Not Found\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fdtl/FdtlControllerAPI.php",
    "groupTitle": "fdtl_API_s"
  },
  {
    "type": "POST",
    "url": "/api/fdtl/fdtl_store_third_landing/{id}",
    "title": "Third Landing",
    "name": "Third_Landing",
    "group": "fdtl_API_s",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "aircraft_callsign",
            "description": "<p>Aircraft Callsign</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_aerodrome",
            "description": "<p>Departure Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "destination_aerodrome",
            "description": "<p>Destination Aerodrome</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "date_of_flight",
            "description": "<p>Date Of Flight</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "departure_time",
            "description": "<p>Departure Time</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "total_flying_time",
            "description": "<p>Total Flying Time</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS_MESSAGE",
            "description": "<p>Success .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "STATUS",
            "description": "<p>200 .</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n\"STATUS\": \"200\",\n\"STATUS_MESSAGE\": \"Success\",\n\"data\": {\n\"reporting_time\": \"0515 GMT (1045 IST)\",\n\"chocks_off\": \"0555 GMT (1125 IST)\",\n\"chocks_on\": \"1005 GMT (1535 IST)\",\n\"duty_end_time\": \"1020 GMT (1550 IST)\",\n\"flight_time\": \"04 Hours 10 Minutes \",\n\"flight_duty_period\": \"05 Hours 05 Minutes \",\n\"split_duty\": \"NOT APPLICABLE\",\n\"split_duty_condition_value\": \"0\",\n\"total_FT\": \"04 Hours 10 Minutes \",\n\"total_FT_condition_value\": \"0\",\n\"total_fdp\": \"05 Hours 05 Minutes \",\n\"total_fdp_condition_value\": \"0\",\n\"last_dep_time\": \"21:05 (WITHOUT SPLIT DUTY)\",\n\"last_arrival_time\": \"22:45 (WITHOUT SPLIT DUTY)\",\n\"next_day_take_off\": \"00:50 GMT (0620 IST)\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "\n{\n  \"STATUS\" => \"404\",\n  \"STATUS_MESSAGE\": \"Not Found\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "./Fdtl/FdtlControllerAPI.php",
    "groupTitle": "fdtl_API_s"
  }
] });
