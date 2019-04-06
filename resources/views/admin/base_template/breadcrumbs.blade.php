<!-- You can dynamically generate breadcrumbs here -->
<ol class="breadcrumb">
    <?php
    $url = url()->full();
    $urls = $array=explode('/', $url);
    ?>

    <li><a href="{{ url('/'.$urls[3]) }}"><i class="fa fa-dashboard"></i>{{ $urls[3] }}</a></li>
    <li class="active">{{ $urls[4] }}</li>
</ol>