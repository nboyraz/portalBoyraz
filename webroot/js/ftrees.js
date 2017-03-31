var root = 
    {
        "name": "Bilinmeyen Boyraz",
        "children":[
            {
                "name": "Mustafa Boyraz",
                "children":[
                    {
                        "name": "Ali Boyraz",
                        "children": [
                            {
                                "name": "Ayşe Boyraz",
                                "children": [
                                    {
                                        "name": "Mehmet Boyraz",
                                        "children":[
                                            {"name": "Ebru Boyraz"},
                                            {"name": "Ersin Boyraz", "children":[{"name":"Azra Boyraz"},{"name":"Arda Boyraz"}]}
                                        ]
                                    },
                                    {"name": "Tahsin Boyraz"},
                                    {"name": "I. Hakki Boyraz"},
                                    {"name": "Ilhan Boyraz"}
                                ]
                            },
                            {
                                "name": "Yusuf Boyraz",
                                "children": [
                                    {"name": "Ozkan Boyraz", "children":[{"name":"Azra Boyraz"},{"name":"Ayse Boyraz"},{"name":"Melike Boyraz"}]},
                                    {"name": "Ozdal Boyraz"},
                                    {"name": "Mustafa Boyraz"},
                                    {"name": "Abuseyf Boyraz"},
                                    {"name": "Yildiz Ozhan", "children":[{"name":"Merve Ozhan"},{"name":"Emirhan Ozhan"},{"name":"Hakan Ozhan"}]},
                                    {"name": "Necip Fazil Boyraz"}
                                ]
                            },
                            {"name": "Fatma Boyraz"},
                            {"name": "Elif Boyraz"},
                            {"name": "Havva Ozhan", "children":[{"name":"Sevda Ozhan"},{"name":"Kagan Ozhan", "children":[{"name":"Merve Ozhan"},{"name":"Emirhan Ozhan"},{"name":"Hakan Ozhan"}]},{"name":"Melehat Ozhan"}]}
                        ]
                    },
                    {
                        "name":"Kucuk Aga",
                        "children": [
                            {"name": "Mahmut Boyraz", "children":[{"name":"Emine Boyraz"},{"name":"Mustafa Boyraz"},{"name":"Nuray Boyraz"},{"name":"Nurhan Boyraz"},{"name":"Munevver Boyraz"},{"name":"Hamit Boyraz"},{"name":"Sait Boyraz"},{"name":"Dilara Boyraz"}]},
                            {"name": "Seyfettin Boyraz", "children":[{"name":"Mehmet Boyraz"},{"name":"Kahraman Boyraz"},{"name":"Nursel Boyraz"},{"name":"Mustafa Boyraz"}]}
                        ]
                    }
                ]
            },
            {"name": "Mudur Ahmet Efendi"}
        ]
    };

$( document ).ready(function() {
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
    }

    function clickName(){
        alert("isme cift tiklayinca panel acilacak!!!");
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
            .on("click", click);

        nodeEnter.append("circle")
            .attr("r", 1e-6)
            .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

        nodeEnter.append("text")
            .attr("y", function(d) { return d.children || d._children ? -18 : 18; })
            .attr("dy", ".35em")
            .attr("text-anchor", "middle")
            .text(function(d) { return d.name; })
            .style("fill-opacity", 1e-6)
            .on("dblclick", clickName);

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
/************************************************************************************/
/************************************************************************************/
/************************************************************************************/
/*
var root = 
            {
                "name": "Ali Boyraz",
                "children": [
                    {
                        "name": "Ayşe Boyraz",
                        "children": [
                            {"name": "Mehmet Boyraz"},
                            {"name": "Tahsin Boyraz"},
                            {"name": "I. Hakki Boyraz"},
                            {"name": "Ilhan Boyraz"}
                        ]
                    },
                    {
                        "name": "Yusuf Boyraz",
                        "children": [
                            {"name": "Ozkan Boyraz"},
                            {"name": "Ozdal Boyraz"},
                            {"name": "Mustafa Boyraz"},
                            {"name": "Abuseyf Boyraz"},
                            {"name": "Yildiz Ozhan"},
                            {"name": "Necip Fazil Boyraz"}
                        ]
                    }
                ]
            };
$( document ).ready(function() {
    var margin = {top: 40, right: 20, bottom: 40, left: 20},
    width = $("#ftree_container").width() - margin.left - margin.right,
    height = ($(window).height() - $("#MainNavBar").height() - $("#footer").height()-80) - margin.top - margin.bottom;
    var orientations = {
        "BOYRAZ SOYAĞACI": {
            size: [width, height],
            x: function(d) { return d.x; },
            y: function(d) { return d.y; }
        }
    };

    var svg = d3.select("#ftree_container").selectAll("svg")
        .data(d3.entries(orientations))
    .enter().append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    svg.append("text")
        .attr("x", 6)
        .attr("y", 6)
        .attr("dy", ".71em")
        .text(function(d) { return d.key; });

    svg.each(function(orientation) {
        var svg = d3.select(this),
        o = orientation.value;
        // Compute the layout.
        var tree = d3.layout.tree().size(o.size),//d3.layout.tree().size(o.size)
        nodes = tree.nodes(root),
        links = tree.links(nodes);
        // Create the link lines.
        svg.selectAll(".link")
        .data(links)
        .enter().append("path")
        .attr("class", "link")
        .attr("d", d3.svg.diagonal().projection(function(d) { return [o.x(d), o.y(d)]; }));
        // Create the node circles.
        svg.selectAll(".node")
        .data(nodes)
        .enter().append("circle")
        .attr("class", "node")
        .attr("r", 4.5)
        .attr("cx", o.x)
        .attr("cy", o.y);
    });
});
*/