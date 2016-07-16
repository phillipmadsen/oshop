<?php

	public function getPublishedAtAttribute($published_at)
    {
        return $this->attributes['publish_at'] = Carbon::parse($publish_at)->format('m-d-Y');
    }
