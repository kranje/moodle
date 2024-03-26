<?php

namespace Sabberworm\CSS;

<<<<<<< HEAD
interface Renderable
{
    /**
     * @return string
     */
    public function __toString();

    /**
     * @return string
     */
    public function render(OutputFormat $oOutputFormat);

    /**
     * @return int
     */
    public function getLineNo();
}
=======
interface Renderable {
	public function __toString();
	public function render(\Sabberworm\CSS\OutputFormat $oOutputFormat);
	public function getLineNo();
}
>>>>>>> forked/LAE_400_PACKAGE
