<?php

namespace Packback\Lti1p3;

class LtiDeepLinkResource
{
    private $type = 'ltiResourceLink';
    private $title;
    private $text;
    private $url;
<<<<<<< HEAD
    private $line_item;
    private $icon;
    private $thumbnail;
    private $custom_params = [];
    private $target = 'iframe';

    public static function new(): LtiDeepLinkResource
=======
    private $lineitem;
    private $custom_params = [];
    private $target = 'iframe';

    public static function new()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new LtiDeepLinkResource();
    }

<<<<<<< HEAD
    public function getType(): string
=======
    public function getType()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->type;
    }

<<<<<<< HEAD
    public function setType(string $value): LtiDeepLinkResource
=======
    public function setType($value)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->type = $value;

        return $this;
    }

<<<<<<< HEAD
    public function getTitle(): ?string
=======
    public function getTitle()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->title;
    }

<<<<<<< HEAD
    public function setTitle(?string $value): LtiDeepLinkResource
=======
    public function setTitle($value)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->title = $value;

        return $this;
    }

<<<<<<< HEAD
    public function getText(): ?string
=======
    public function getText()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->text;
    }

<<<<<<< HEAD
    public function setText(?string $value): LtiDeepLinkResource
=======
    public function setText($value)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->text = $value;

        return $this;
    }

<<<<<<< HEAD
    public function getUrl(): ?string
=======
    public function getUrl()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->url;
    }

<<<<<<< HEAD
    public function setUrl(?string $value): LtiDeepLinkResource
=======
    public function setUrl($value)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->url = $value;

        return $this;
    }

<<<<<<< HEAD
    public function getLineItem(): ?LtiLineitem
    {
        return $this->line_item;
    }

    public function setLineItem(?LtiLineitem $value): LtiDeepLinkResource
    {
        $this->line_item = $value;
=======
    public function getLineitem()
    {
        return $this->lineitem;
    }

    public function setLineitem(LtiLineitem $value)
    {
        $this->lineitem = $value;
>>>>>>> forked/LAE_400_PACKAGE

        return $this;
    }

<<<<<<< HEAD
    public function setIcon(?LtiDeepLinkResourceIcon $icon): LtiDeepLinkResource
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): ?LtiDeepLinkResourceIcon
    {
        return $this->icon;
    }

    public function setThumbnail(?LtiDeepLinkResourceIcon $thumbnail): LtiDeepLinkResource
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getThumbnail(): ?LtiDeepLinkResourceIcon
    {
        return $this->thumbnail;
    }

    public function getCustomParams(): array
=======
    public function getCustomParams()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->custom_params;
    }

<<<<<<< HEAD
    public function setCustomParams(array $value): LtiDeepLinkResource
=======
    public function setCustomParams($value)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->custom_params = $value;

        return $this;
    }

<<<<<<< HEAD
    public function getTarget(): string
=======
    public function getTarget()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->target;
    }

<<<<<<< HEAD
    public function setTarget(string $value): LtiDeepLinkResource
=======
    public function setTarget($value)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->target = $value;

        return $this;
    }

<<<<<<< HEAD
    public function toArray(): array
=======
    public function toArray()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $resource = [
            'type' => $this->type,
            'title' => $this->title,
            'text' => $this->text,
            'url' => $this->url,
            'presentation' => [
                'documentTarget' => $this->target,
            ],
<<<<<<< HEAD
        ];
        if (!empty($this->custom_params)) {
            $resource['custom'] = $this->custom_params;
        }
        if (isset($this->icon)) {
            $resource['icon'] = $this->icon->toArray();
        }
        if (isset($this->thumbnail)) {
            $resource['thumbnail'] = $this->thumbnail->toArray();
        }
        if ($this->line_item !== null) {
            $resource['lineItem'] = [
                'scoreMaximum' => $this->line_item->getScoreMaximum(),
                'label' => $this->line_item->getLabel(),
=======
            'custom' => $this->custom_params,
        ];
        if ($this->lineitem !== null) {
            $resource['lineItem'] = [
                'scoreMaximum' => $this->lineitem->getScoreMaximum(),
                'label' => $this->lineitem->getLabel(),
>>>>>>> forked/LAE_400_PACKAGE
            ];
        }

        return $resource;
    }
}
