<?php

namespace Sabberworm\CSS\Comment;

<<<<<<< HEAD
interface Commentable
{
    /**
     * @param array<array-key, Comment> $aComments
     *
     * @return void
     */
    public function addComments(array $aComments);

    /**
     * @return array<array-key, Comment>
     */
    public function getComments();

    /**
     * @param array<array-key, Comment> $aComments
     *
     * @return void
     */
    public function setComments(array $aComments);
=======
interface Commentable {

	/**
	 * @param array $aComments Array of comments.
	 */
	public function addComments(array $aComments);

	/**
	 * @return array
	 */
	public function getComments();

	/**
	 * @param array $aComments Array containing Comment objects.
	 */
	public function setComments(array $aComments);


>>>>>>> forked/LAE_400_PACKAGE
}
