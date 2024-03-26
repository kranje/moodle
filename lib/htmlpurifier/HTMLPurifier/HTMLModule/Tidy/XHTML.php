<<<<<<< HEAD
<?php

class HTMLPurifier_HTMLModule_Tidy_XHTML extends HTMLPurifier_HTMLModule_Tidy
{
    /**
     * @type string
     */
    public $name = 'Tidy_XHTML';

    /**
     * @type string
     */
    public $defaultLevel = 'medium';

    /**
     * @return array
     */
    public function makeFixes()
    {
        $r = array();
        $r['@lang'] = new HTMLPurifier_AttrTransform_Lang();
        return $r;
    }
}

// vim: et sw=4 sts=4
=======
<?php

class HTMLPurifier_HTMLModule_Tidy_XHTML extends HTMLPurifier_HTMLModule_Tidy
{
    /**
     * @type string
     */
    public $name = 'Tidy_XHTML';

    /**
     * @type string
     */
    public $defaultLevel = 'medium';

    /**
     * @return array
     */
    public function makeFixes()
    {
        $r = array();
        $r['@lang'] = new HTMLPurifier_AttrTransform_Lang();
        return $r;
    }
}

// vim: et sw=4 sts=4
>>>>>>> forked/LAE_400_PACKAGE
