<?php

// Include global config
include_once 'config/config.php';

// Display the header files
include_once 'layouts/header.html';
define('DATE_FORMAT','m-d-Y');
echo '<h1>The blog archive</h1>';

echo "<ul>\n";
$directory = POSTS_DIR . '/';

// Ensure the directory isn't empty
if (glob($directory . '*.md') != FALSE)
{
    $file_count = count(glob($directory . '*.md'));
    $files = glob($directory . '*.md', GLOB_NOSORT);
    array_multisort(array_map('filemtime', $files), SORT_NUMERIC, SORT_DESC, $files);
    foreach ($files as $file)
    {
	$f=new PostFilename($file);
        echo '<li>';
	if ($f->date)
		echo $f->date->format(DATE_FORMAT).' ';
	echo '<a href="posts' . $post->path_to_post($file) . '">' . $f->title . '</a></li>';
    }
}
echo "</ul>\n";

include_once 'layouts/footer.html';

?>
