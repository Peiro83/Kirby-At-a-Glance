<?php

global $site;
$site = site();

return array(
  'title' => 'At a glance',
  'options' => array(
      array(
        'text' => 'Visit Site',
        'icon' => 'eye',
        'link' => $site->url(),
        'target' => '_blank'
      )
    ),
  'html'  => function() {
    global $site;

    $count_chapters = 0;
    $count_subpages = 0;
    $count_images = 0;
    $count_files = 0;
    $count_users = $site->users()->count();

    foreach($site->pages() as $page):
      $count_chapters++;
      $count_images += $page->images()->count();
      $count_files += $page->documents()->count();

        $children = $page->children();
        foreach($children as $child):
          $count_subpages++;
          $count_images += $child->images()->count();
          $count_files += $child->documents()->count();
        endforeach;

    endforeach;

    $count_pages = $count_chapters + $count_subpages;

  	return  "<style>
              #glance-widget td {
                padding: 0 .75em .25em 0;
              }
              #glance-widget tr td:first-of-type {
                color: #666;
              }
            </style>".

            "<table>".
              "<tr><td>Chapters</td><td><b>$count_chapters</b></td></tr>".
              "<tr><td>Pages</td><td><b>$count_pages</b></td></tr>".
              "<tr><td>Images</td><td><b>$count_chapters</b></td></tr>".
              "<tr><td>Files</td><td><b>$count_files</b></td></tr>".
              "<tr><td>Users</td><td><b>$count_users</b></td></tr>".
            "</table>";
    }
);

?>