<h1>Credits</h1>
<ul>
    @loop author : authors
        <li><a href="{{author.page}}">{{ author.name }}</a></li>
    @endloop
</ul>
