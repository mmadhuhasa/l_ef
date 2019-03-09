<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="ProgId" content="Word.Document" />
        <title></title>
	<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	    <style type="text/css">
		/* Based on The MailChimp Reset INLINE: Yes. */  
		/* Client-specific Styles */
		/*#outlook a {padding:0;}  Force Outlook to provide a "view in browser" menu link. */

		body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;font-family: 'PT Sans';} 

		/* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/ 
		.ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */  
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
		/* Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */ 
		#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
		/* End reset */

		/* Some sensible defaults for images
		Bring inline: Yes. */
		img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} 
		a img {border:none;} 
		.image_fix {display:block;}

		/* Yahoo paragraph fix
		Bring inline: Yes. */
		p {margin: 1em 0;}

		/* Hotmail header color reset
		Bring inline: Yes. */
		h1, h2, h3, h4, h5, h6 {color: black !important;}

		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
		    color: red !important; /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
		}

		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
		    color: purple !important;  
		    /*Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure.*/
		}

		/* Outlook 07, 10 Padding issue fix
		Bring inline: No.*/
		table td {border-collapse: collapse;}

		/* Remove spacing around Outlook 07, 10 tables
		Bring inline: Yes */
		table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }


		/* MOBILE TARGETING */
		@media only screen and (max-device-width: 480px) {
		    /* Part one of controlling phone number linking for mobile. */
		    a[href^="tel"], a[href^="sms"] {
			text-decoration: none;
			color: blue; /* or whatever your want */
			pointer-events: none;
			cursor: default;
		    }

		    .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
			text-decoration: default;
			color: orange !important;
			pointer-events: auto;
			cursor: default;
		    }

		}

		/* More Specific Targeting */

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		    /* You guessed it, ipad (tablets, smaller screens, etc) */
		    /* repeating for the ipad */
		    a[href^="tel"], a[href^="sms"] {
			text-decoration: none;
			color: blue; /* or whatever your want */
			pointer-events: none;
			cursor: default;
		    }

		    .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
			text-decoration: default;
			color: orange !important;
			pointer-events: auto;
			cursor: default;
		    }
		}
	    </style>
    </head>
    <body style="padding:0; margin:0;" bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        @yield('container')
        <span style="padding: 0px;"></span>
    </body>
</html>