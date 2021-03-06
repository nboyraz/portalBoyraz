$( document ).ready(function() {
    var root;
    $.ajax({
        type:"post",
        url: $("html").attr("ajax_prelink") + "GetFtreeByRoot/",
        data:{ method_type: "ajax" },//data hata veriyor
        dataType:"json",
        async: false,
        success:function(res){ 
            root = res; 
        }
    });

    var margin = {top: 60, right: 20, bottom: 40, left: 20},
    width,
    height,
    _width,
    _height;
    calculateInitialSizes();

    function calculateInitialSizes(){
        width = $(window).width() - margin.left - margin.right;
        height = ($(window).height() - $("#MainNavBar").height()) - margin.top - margin.bottom;
        _width = width;
        _height = height;
        $("#ftree_container").css("height",(height + margin.top + margin.bottom)+"px");//vertical scroll icin
    }

    window.addEventListener('resize', function(event){
        calculateInitialSizes();
        setSize();
        update(root);
    });

    var i = 0,
        duration = 1500,
        duration_short = 750,
        levelChildrenCounter = [];

    var tree = d3.layout.tree()
        .size([width, height]);

    var diagonal = d3.svg.diagonal()
        .projection(function(d) { return [d.x, d.y]; });

    var svg = d3.select("#ftree_container").append("svg")
        .attr("width", width + margin.right + margin.left)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
    
    var defs = svg.append('svg:defs');
    defs.append("svg:pattern")
    .attr("id", "blank_avatar")
    .attr("width", 30)
    .attr("height", 30)
    .append("svg:image")
    .attr("xlink:href", $("html").attr("site_domain") + 'webroot/img/neco.png')
    .attr("width", 30)
    .attr("height", 30)
    .attr("x", 0)
    .attr("y", 0);

    function collapse(d) {

        if (d.children) {
        d._children = d.children;
        d._children.forEach(collapse);
        d.children = null;
        }
    }

    root.children.forEach(collapse);
    update(root);    

    function getTotalDepth(source,level){
        var _res = 1;
        if(source.children){
            var _depths = [];
            for(var i=0;i<source.children.length;i++){
                _depths.push(getTotalDepth(source.children[i],level+1));
            }
            _res = Math.max.apply(null, _depths) + 1;
        }
        if(levelChildrenCounter[level+'.'])
            levelChildrenCounter[level+'.'] = levelChildrenCounter[level+'.'] + 1;
        else
            levelChildrenCounter[level+'.'] = 1;
        return _res;
    }

    function setSize(){
        levelChildrenCounter = [];
        var maxDepth = getTotalDepth(root,1); 
        var _tmpLevelElms = [];
        for(var key in levelChildrenCounter) {
            _tmpLevelElms.push(levelChildrenCounter[key]);
        }       
        var maxSize = Math.max.apply(null, _tmpLevelElms);
        if(height < (maxDepth * 100)){
            _height = maxDepth * 100;
        }
        else{
            _height = height;
        }
        if(width < (maxSize * 90)){
            _width = maxSize * 90;
        }
        else{
            _width = width;
        }
        d3.select("svg").attr("height", _height + margin.top + margin.bottom)
            .attr("width", _width + margin.right + margin.left);
        tree.size([_width, _height]);
    }

    // Toggle children on click.
    function click(d) {
        if (d.children) {
            d._children = d.children;
            d.children = null;
        } else {
            d.children = d._children;
            d._children = null;
        }
        setSize();
        update(d);
        //bazen circle renkli kalabiliyor
        var idcircle = "#circle"+d.id;
        d3.select(idcircle).style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });
    }

    function displayInfo(d){
        var textid = "#text"+d.id;
        var win_width = $(window).width();
        var win_height = $(window).height();
        var text_top_pos = $(textid).offset().top;
        var text_left_pos = $(textid).offset().left;
        var info_width = $('#ftree_person_popup').width();
        var info_height = $('#ftree_person_popup').height();
        var info_pos_top,info_pos_left;
        info_pos_left = win_width < info_width ? 0 : (win_width < (info_width*2) + 50 ? (win_width-info_width)/2 : (text_left_pos < win_width/2 ? (text_left_pos + 50) : (text_left_pos-info_width)));
        info_pos_top = win_height < info_height ? 0 : (win_height < (info_height*2) ? (win_height-info_height)/2 : (text_top_pos < win_height/2 ? (text_top_pos) : (text_top_pos-info_height)));
        $('#ftree_person_popup').css('display',"block");
        $('#ftree_person_popup').css('left',info_pos_left);
        $('#ftree_person_popup').css('top',info_pos_top);
        $('#ftree_person_popup').focus();
        //info bilgiler
        $('#ftree_person_popup_img img').attr('src', $("html").attr("site_domain") + 'webroot/img/neco.png');
        $('#ftree_person_popup_img span').html(d.name);
        $('#ftree_person_popup_info').html("Dogum Yili:<br/><br/>Yasadigi sehir:<br/><br/>Meslek/Okul:<br/><br/>Koy:<br/>");
    }

    function closePersonInfo(){
        $('#ftree_person_popup').css('display',"none");
    }

    $('#ftree_person_popup_close').click(function(){
        closePersonInfo();
    });

    function HoverNode(d){
        var idcircle = "#circle"+d.id;
        d3.select(idcircle).transition().duration(duration_short).attr("r","15");
        try{
            d3.select(idcircle).style("fill", "url(#blank_avatar)");
        }
        catch(err){}
    }

    function UnHoverNode(d){
        var idcircle = "#circle"+d.id;
        d3.select(idcircle).transition().duration(duration_short).attr("r","4.5");
        try{
            d3.select(idcircle).style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });
        }
        catch(err){}
    }

    function update(source) {
        // Compute the new tree layout.
        var nodes = tree.nodes(root).reverse(),
            links = tree.links(nodes);

        // Normalize for fixed-depth.
        nodes.forEach(function(d) { d.y = d.depth * 100; });

        // Update the nodes…
        var node = svg.selectAll("g.node")
            .data(nodes, function(d) { return d.id || (d.id = ++i); });

        // Enter any new nodes at the parent's previous position.
        var nodeEnter = node.enter().append("g")
            .attr("class", "node")
            .attr("transform", function(d) { return "translate(" + source.x0 + "," + source.y0 + ")"; })
            .on("mouseover", HoverNode)
            .on("mouseout", UnHoverNode);

        nodeEnter.append("circle")
            .attr("r", 1e-6)
            .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; })
            .attr("id",function(d){ return "circle"+d.id; })
            .on("click", click);

        nodeEnter.append("text")
            .attr("y", function(d) { return d.children || d._children ? -18 : 18; })
            .attr("dy", ".35em")
            .attr("text-anchor", "middle")
            .text(function(d) { return d.name; })
            .style("fill-opacity", 1e-6)
            .attr("id",function(d){ return "text"+d.id; })
            .on("click", displayInfo);

        // Transition nodes to their new position.
        var nodeUpdate = node.transition()
            .duration(duration)
            .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

        nodeUpdate.select("circle")
            .attr("r", 4.5)
            .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

        nodeUpdate.select("text")
            .style("fill-opacity", 1);

        // Transition exiting nodes to the parent's new position.
        var nodeExit = node.exit().transition()
            .duration(duration)
            .attr("transform", function(d) { return "translate(" + source.x + "," + source.y + ")"; })
            .remove();

        nodeExit.select("circle")
            .attr("r", 1e-6);

        nodeExit.select("text")
            .style("fill-opacity", 1e-6);

        // Update the links…
        var link = svg.selectAll("path.link")
            .data(links, function(d) { return d.target.id; });

        // Enter any new links at the parent's previous position.
        link.enter().insert("path", "g")
            .attr("class", "link")
            .attr("d", function(d) {
                var o = {x: source.x0, y: source.y0};
                return diagonal({source: o, target: o});
            });

        // Transition links to their new position.
        link.transition()
            .duration(duration)
            .attr("d", diagonal);

        // Transition exiting nodes to the parent's new position.
        link.exit().transition()
            .duration(duration)
            .attr("d", function(d) {
                var o = {x: source.x, y: source.y};
                return diagonal({source: o, target: o});
            })
            .remove();

        // Stash the old positions for transition.
        nodes.forEach(function(d) {
            d.x0 = d.x;
            d.y0 = d.y;
        });
    }
});
