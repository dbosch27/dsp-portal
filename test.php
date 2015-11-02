<html>
    <head>
        <style>
#wrapper {
  padding-left: 250px;
  transition: all 0.4s ease 0s;
}

#sidebar-wrapper {
  margin-left: -250px;
  left: 250px;
  width: 250px;
  background: #000;
  position: fixed;
  height: 100%;
  overflow-y: auto;
  z-index: 1000;
  transition: all 0.4s ease 0s;
}

#page-content-wrapper {
  width: 100%;
}

.sidebar-nav {
  position: absolute;
  top: 0;
  width: 250px;
  list-style: none;
  margin: 0;
  padding: 0;
}

@media (max-width:767px) {

    #wrapper {
      padding-left: 0;
    }

    #sidebar-wrapper {
      left: 0;
    }

    #wrapper.active {
      position: relative;
      left: 250px;
    }

    #wrapper.active #sidebar-wrapper {
      left: 250px;
      width: 250px;
      transition: all 0.4s ease 0s;
    }

}
        </style>

    </head>
    <body>
        <div id="wrapper">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand"><a href="#">Home</a></li>
                    <li><a href="#">Another link</a></li>
                    <li><a href="#">Next link</a></li>
                    <li><a href="#">Last link</a></li>
                </ul>
            </div>
            <div id="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- content of page -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>