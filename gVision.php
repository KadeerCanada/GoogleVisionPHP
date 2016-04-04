<?php
/*
Copyright (c) 2016 Sung Kim <hunkim@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */

/*
https://cloud.google.com/vision/docs/requests-and-responses
FACE_DETECTION	Run face detection.
LANDMARK_DETECTION	Run landmark detection.
LOGO_DETECTION	Run logo detection.
LABEL_DETECTION	Run label detection.
TEXT_DETECTION	Run OCR.
SAFE_SEARCH_DETECTION	Run various computer vision models to
*/
function doGoogleVisionRquest($filename, $type="LABEL_DETECTION") {
	$request['requests'] = ['image'=>[], 'features'=>["type"=>$type,  "maxResults"=>999]]; 

	$data = file_get_contents($filename);
	if ($data===FALSE) {
		die("Invalid file/url: $filename\n");
	}

	$request['requests']['image']['content'] =  base64_encode($data);
	$payload = json_encode($request);

	$ch = curl_init(GOOGLE_VISION_END_POINT . GOOGLE_VISION_KEY);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($ch);
	curl_close($ch);

	return $result;
}
?>
