<?php

namespace NotificationChannels\FacebookPoster;

use NotificationChannels\FacebookPoster\Attaches\Link;
use NotificationChannels\FacebookPoster\Attaches\Image;
use NotificationChannels\FacebookPoster\Attaches\Video;

class FacebookPosterPost
{
    /** @var string */
    protected $content;

    /** @object FacebookPosterLink */
    protected $link;

    /** @object FacebookPosterImage */
    protected $image;

    /** @object FacebookPosterVideo */
    protected $video;

    /**
     * @var  string
     */
    private $apiEndpoint = 'me/feed';

    public function __construct($postContent)
    {
        $this->content = $postContent;
    }

    /**
     * Get Post content.
     *
     * @return  string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set facebook post main link
     * @param string $link
     * @return  $this
     */
    public function withLink($link)
    {
        $this->link = new Link($link);
        return $this;
    }

    /**
     * Set facebook post image
     * @param string $link
     * @return  $this
     */
    public function withImage($imagePath,$endpoint = 'me/photos')
    {
        $this->image = new Image($imagePath,$endpoint);
        return $this;
    }
    /**
     * Set facebook post image
     * @param string $link
     * @return  $this
     */
    public function withVideo($videoPath,$data = [],$endpoint = 'me/videos')
    {
        $this->video = new video($videoPath,$endpoint);
        
        if(isset($data['title'])){
        	$this->video->setTitle($data['title']);
        }
        
        if(isset($data['description'])){
        	$this->video->setDescription($data['description']);
        }

        return $this;
    }

    /**
     * Return Facebook Post api endpoint.
     * @return  string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * Build Twitter request body.
     * @return  array
     */
    public function getPostBody()
    {
        $body  = [
        	'message' => $this->getContent(),
    	];

    	if($this->link != null)
    	{
    		$body['link'] = $this->link->getUrl();
    	}

    	if($this->image != null)
    	{
    		$body['media'] = $this->image;
    	}

    	if($this->video != null)
    	{
    		$body['media'] = $this->video;
    	}

    	return $body;
    }
}
