<?php

namespace Craft;

class TwigExtras_MediaLinksService extends BaseApplicationComponent{

	private function getMediaId($url, $platform = 'youtube')
	{
		switch ($platform){

			case 'youtube':
				$regex = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
				break;
//			case 'vimeo':
//				$regex = '/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/(?:[^\/]*)\/videos\/|album\/(?:\d+)\/video\/|video\/|)(\d+)(?:[a-zA-Z0-9_\-]+)?/i';
//				break;
			default:
				$regex = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
		}

		preg_match($regex, $url, $match);
		$id = $match[1];

		return (!empty($id)) ? $id : "";
	}

	public function getEmbeddedLink($url, $platform = 'youtube')
	{
		$id = $this->getMediaId($url, $platform);

		switch ($platform){

			case 'youtube':
				$link = "https://www.youtube.com/embed/".$id;
				break;
//			case 'vimeo':
//				break;
			default:
				$link = "https://www.youtube.com/embed/".$id;
		}

		return $link;
	}
	
	public function validateUrl($url, $platform = 'youtube')
	{
		$id = $this->getMediaId($url, $platform);

		switch ($platform){

			case 'youtube':
				$theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=".$id."&format=json";
				$headers = get_headers($theURL);
				$isValid = (substr($headers[0], 9, 3) !== "404");
				break;
//			case 'vimeo':
//				break;
			default:
				$theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=".$id."&format=json";
				$headers = get_headers($theURL);
				$isValid = (substr($headers[0], 9, 3) !== "404");
		}

		return $isValid;
	}

}
