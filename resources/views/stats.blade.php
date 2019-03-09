@extends('layouts.fdtl_test',array('1'=>'1'))
@section('content')
<style>
   .titular {
   margin-top:10px;
   text-align: center;
   font-size: 14px;
   font-weight:bold;
   }
   .donut-chart {
   position: relative;
   width: 130px;
   height:130px;
   border-radius: 100%
   }
   p.center-date {
   background: #fff;
   position: absolute;
   text-align: center;
   font-size: 28px;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100px;
   height: 100px;
   margin: auto;
   border-radius: 50%;
   line-height:60px;
   padding: 15% 0 0;
   }
   .recorte {
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 65px);
   height: 100%;
   position: absolute;
   width: 100%;
   }
   .quesito {
   border-radius: 50%;
   clip: rect(0px, 100px, 200px, 0px);
   height: 100%;
   position: absolute;
   width: 100%;
   font-family: monospace;
   font-size: 1.5rem;
   }
   #porcion1 {
   transform: rotate(180deg);
   }
   #porcion1 .quesito {
   background-color: #cfcfcf;
   transform: rotate(180deg);
   }
   #porcionFin {
   transform: rotate(0deg);
   }
   #porcionFin .quesito {
   background-color: #FCB150;
   transform: rotate(180deg);
   }
   .titular2 {
   margin-top:10px;
   text-align: center;
   font-size: 14px;
   font-weight:bold;
   }
   .donut-chart2 {
   position: relative;
   width: 130px;
   height:130px;
   border-radius: 100%
   }
   p.center-date2 {
   background: #fff;
   position: absolute;
   text-align: center;
   font-size: 28px;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100px;
   height: 100px;
   margin: auto;
   border-radius: 50%;
   line-height:60px;
   padding: 15% 0 0;
   }
   .recorte2 {
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 65px);
   height: 100%;
   position: absolute;
   width: 100%;
   }
   .quesito2 {
   border-radius: 50%;
   clip: rect(0px, 100px, 200px, 0px);
   height: 100%;
   position: absolute;
   width: 100%;
   font-family: monospace;
   font-size: 1.5rem;
   }
   #porcion1 .quesito2 {
   background-color: #cfcfcf;
   transform: rotate(180deg);
   }
   #porcionFin2 {
   transform: rotate(0deg);
   }
   #porcionFin2 .quesito2 {
   background-color: #FCB150;
   transform: rotate(180deg);
   }
   .titular3 {
   margin-top:10px;
   text-align: center;
   font-size: 14px;
   font-weight:bold;
   }
   .donut-chart3 {
   position: relative;
   width: 130px;
   height:130px;
   border-radius: 100%
   }
   p.center-date3 {
   background: #fff;
   position: absolute;
   text-align: center;
   font-size: 28px;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100px;
   height: 100px;
   margin: auto;
   border-radius: 50%;
   line-height:60px;
   padding: 15% 0 0;
   }
   .recorte3 {
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 65px);
   height: 100%;
   position: absolute;
   width: 100%;
   }
   .quesito3 {
   border-radius: 50%;
   clip: rect(0px, 100px, 200px, 0px);
   height: 100%;
   position: absolute;
   width: 100%;
   font-family: monospace;
   font-size: 1.5rem;
   }
   #porcion1 .quesito3 {
   background-color: #cfcfcf;
   transform: rotate(180deg);
   }
   #porcionFin3 {
   transform: rotate(0deg);
   }
   #porcionFin3 .quesito3 {
   background-color: #FCB150;
   transform: rotate(180deg);
   }
   .titular4 {
   margin-top:10px;
   text-align: center;
   font-size: 14px;
   font-weight:bold;
   }
   .donut-chart4 {
   position: relative;
   width: 130px;
   height:130px;
   border-radius: 100%
   }
   p.center-date4 {
   background: #fff;
   position: absolute;
   text-align: center;
   font-size: 28px;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100px;
   height: 100px;
   margin: auto;
   border-radius: 50%;
   line-height:60px;
   padding: 15% 0 0;
   }
   .recorte4 {
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 65px);
   height: 100%;
   position: absolute;
   width: 100%;
   }
   .quesito4 {
   border-radius: 50%;
   clip: rect(0px, 100px, 200px, 0px);
   height: 100%;
   position: absolute;
   width: 100%;
   font-family: monospace;
   font-size: 1.5rem;
   }
   #porcion1 .quesito4 {
   background-color: #cfcfcf;
   transform: rotate(180deg);
   }
   #porcionFin4 {
   transform: rotate(0deg);
   }
   #porcionFin4 .quesito4 {
   background-color: #FCB150;
   transform: rotate(180deg);
   }
   .titular5 {
   margin-top:10px;
   text-align: center;
   font-size: 14px;
   font-weight:bold;
   }
   .donut-chart5 {
   position: relative;
   width: 130px;
   height:130px;
   border-radius: 100%
   }
   p.center-date5 {
   background: #fff;
   position: absolute;
   text-align: center;
   font-size: 28px;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100px;
   height: 100px;
   margin: auto;
   border-radius: 50%;
   line-height:60px;
   padding: 15% 0 0;
   }
   .recorte5 {
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 65px);
   height: 100%;
   position: absolute;
   width: 100%;
   }
   .quesito5 {
   border-radius: 50%;
   clip: rect(0px, 100px, 200px, 0px);
   height: 100%;
   position: absolute;
   width: 100%;
   font-family: monospace;
   font-size: 1.5rem;
   }
   #porcion1 .quesito5 {
   background-color: #cfcfcf;
   transform: rotate(180deg);
   }
   #porcionFin5 {
   transform: rotate(0deg);
   }
   #porcionFin5 .quesito5 {
   background-color: #FCB150;
   transform: rotate(180deg);
   }
   .titular6 {
   margin-top:10px;
   text-align: center;
   font-size: 14px;
   font-weight:bold;
   }
   .donut-chart6 {
   position: relative;
   width: 130px;
   height:130px;
   border-radius: 100%
   }
   p.center-date6 {
   background: #fff;
   position: absolute;
   text-align: center;
   font-size: 28px;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100px;
   height: 100px;
   margin: auto;
   border-radius: 50%;
   line-height:60px;
   padding: 15% 0 0;
   }
   .recorte6 {
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 65px);
   height: 100%;
   position: absolute;
   width: 100%;
   }
   .quesito6 {
   border-radius: 50%;
   clip: rect(0px, 100px, 200px, 0px);
   height: 100%;
   position: absolute;
   width: 100%;
   font-family: monospace;
   font-size: 1.5rem;
   }
   #porcion1 .quesito6 {
   background-color: #cfcfcf;
   transform: rotate(180deg);
   }
   #porcionFin6 {
   transform: rotate(0deg);
   }
   #porcionFin6 .quesito6 {
   background-color: #FCB150;
   transform: rotate(180deg);
   }
   .mainrow{
   width: 1000px;
   margin: 0 auto;
   padding-top: 20px;
   padding-bottom: 20px;
   }
   .statsheader{
   padding:5px;
   color:#000;
   font-weight:bold;
   }

   .donut-chart7 {
   position: relative;
   width: 130px;
   height:130px;
   border-radius: 100%;
   margin-left: 15%;
   }
   p.center-date7 {
   background: #fff;
   position: absolute;
   text-align: center;
   font-size: 28px;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100px;
   height: 100px;
   margin: auto;
   border-radius: 50%;
   line-height:60px;
   padding: 15% 0 0;
   }
   .recorte7 {
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 65px);
   height: 100%;
   position: absolute;
   width: 100%;
   }
   .quesito7 {
   border-radius: 50%;
   clip: rect(0px, 100px, 200px, 0px);
   height: 100%;
   position: absolute;
   width: 100%;
   font-family: monospace;
   font-size: 1.5rem;
   }
   #porcion1 .quesito7 {
   background-color: #cfcfcf;
   transform: rotate(180deg);
   }
   #porcionFin7 {
   transform: rotate(0deg);
   }
   #porcionFin7 .quesito7 {
   background-color: #FCB150;
   transform: rotate(180deg);
   }

  .donut-chart8 {
   position: relative;
   width: 130px;
   height:130px;
   border-radius: 100%;
   margin-left:12%;
   }
   p.center-date8 {
   background: #fff;
   position: absolute;
   text-align: center;
   font-size: 28px;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100px;
   height: 100px;
   margin: auto;
   border-radius: 50%;
   line-height:60px;
   padding: 15% 0 0;
   }
   .recorte8 {
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 65px);
   height: 100%;
   position: absolute;
   width: 100%;
   }
   .quesito8 {
   border-radius: 50%;
   clip: rect(0px, 100px, 200px, 0px);
   height: 100%;
   position: absolute;
   width: 100%;
   font-family: monospace;
   font-size: 1.5rem;
   }
   #porcion1 .quesito8 {
   background-color: #cfcfcf;
   transform: rotate(180deg);
   }
   #porcionFin8 {
   transform: rotate(0deg);
   }
   #porcionFin8 .quesito8 {
   background-color: #FCB150;
   transform: rotate(180deg);
   }
   .seven_wrapper_main{
       background:#fff;
       padding:50px 0px 50px 0px;
   }
   .eight_wrapper_main{
       background:#fff;
       padding:50px 0px 50px 0px;
   }
   .adc_delayed_wrapper{
     max-height: 180px;
     overflow-y: scroll; 
   }
   .last_sub_main_wrapper{
     margin-bottom: 50px;  
   }
   .client_sub_wrapper{
       padding-left:0px;
   }
   .eflight_sub_wrapper{
       padding-right:0px;
   }
   .client_sub{
     background: #fff;
     height:75px;
     text-align: center;
   }




   /****************************************************************
 *
 * CSS Percentage Circle
 * Author: Andre Firchow
 *
*****************************************************************/
.rect-auto, .c100.p51 .slice, .c100.p52 .slice, .c100.p53 .slice, .c100.p54 .slice, .c100.p55 .slice, .c100.p56 .slice, .c100.p57 .slice, .c100.p58 .slice, .c100.p59 .slice, .c100.p60 .slice, .c100.p61 .slice, .c100.p62 .slice, .c100.p63 .slice, .c100.p64 .slice, .c100.p65 .slice, .c100.p66 .slice, .c100.p67 .slice, .c100.p68 .slice, .c100.p69 .slice, .c100.p70 .slice, .c100.p71 .slice, .c100.p72 .slice, .c100.p73 .slice, .c100.p74 .slice, .c100.p75 .slice, .c100.p76 .slice, .c100.p77 .slice, .c100.p78 .slice, .c100.p79 .slice, .c100.p80 .slice, .c100.p81 .slice, .c100.p82 .slice, .c100.p83 .slice, .c100.p84 .slice, .c100.p85 .slice, .c100.p86 .slice, .c100.p87 .slice, .c100.p88 .slice, .c100.p89 .slice, .c100.p90 .slice, .c100.p91 .slice, .c100.p92 .slice, .c100.p93 .slice, .c100.p94 .slice, .c100.p95 .slice, .c100.p96 .slice, .c100.p97 .slice, .c100.p98 .slice, .c100.p99 .slice, .c100.p100 .slice {
  clip: rect(auto, auto, auto, auto);
}

.pie, .c100 .bar, .c100.p51 .fill, .c100.p52 .fill, .c100.p53 .fill, .c100.p54 .fill, .c100.p55 .fill, .c100.p56 .fill, .c100.p57 .fill, .c100.p58 .fill, .c100.p59 .fill, .c100.p60 .fill, .c100.p61 .fill, .c100.p62 .fill, .c100.p63 .fill, .c100.p64 .fill, .c100.p65 .fill, .c100.p66 .fill, .c100.p67 .fill, .c100.p68 .fill, .c100.p69 .fill, .c100.p70 .fill, .c100.p71 .fill, .c100.p72 .fill, .c100.p73 .fill, .c100.p74 .fill, .c100.p75 .fill, .c100.p76 .fill, .c100.p77 .fill, .c100.p78 .fill, .c100.p79 .fill, .c100.p80 .fill, .c100.p81 .fill, .c100.p82 .fill, .c100.p83 .fill, .c100.p84 .fill, .c100.p85 .fill, .c100.p86 .fill, .c100.p87 .fill, .c100.p88 .fill, .c100.p89 .fill, .c100.p90 .fill, .c100.p91 .fill, .c100.p92 .fill, .c100.p93 .fill, .c100.p94 .fill, .c100.p95 .fill, .c100.p96 .fill, .c100.p97 .fill, .c100.p98 .fill, .c100.p99 .fill, .c100.p100 .fill {
  position: absolute;
  border: 0.08em solid #307bbb;
  width: 0.84em;
  height: 0.84em;
  clip: rect(0em, 0.5em, 1em, 0em);
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  -o-border-radius: 50%;
  border-radius: 50%;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -ms-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
}

.pie-fill, .c100.p51 .bar:after, .c100.p51 .fill, .c100.p52 .bar:after, .c100.p52 .fill, .c100.p53 .bar:after, .c100.p53 .fill, .c100.p54 .bar:after, .c100.p54 .fill, .c100.p55 .bar:after, .c100.p55 .fill, .c100.p56 .bar:after, .c100.p56 .fill, .c100.p57 .bar:after, .c100.p57 .fill, .c100.p58 .bar:after, .c100.p58 .fill, .c100.p59 .bar:after, .c100.p59 .fill, .c100.p60 .bar:after, .c100.p60 .fill, .c100.p61 .bar:after, .c100.p61 .fill, .c100.p62 .bar:after, .c100.p62 .fill, .c100.p63 .bar:after, .c100.p63 .fill, .c100.p64 .bar:after, .c100.p64 .fill, .c100.p65 .bar:after, .c100.p65 .fill, .c100.p66 .bar:after, .c100.p66 .fill, .c100.p67 .bar:after, .c100.p67 .fill, .c100.p68 .bar:after, .c100.p68 .fill, .c100.p69 .bar:after, .c100.p69 .fill, .c100.p70 .bar:after, .c100.p70 .fill, .c100.p71 .bar:after, .c100.p71 .fill, .c100.p72 .bar:after, .c100.p72 .fill, .c100.p73 .bar:after, .c100.p73 .fill, .c100.p74 .bar:after, .c100.p74 .fill, .c100.p75 .bar:after, .c100.p75 .fill, .c100.p76 .bar:after, .c100.p76 .fill, .c100.p77 .bar:after, .c100.p77 .fill, .c100.p78 .bar:after, .c100.p78 .fill, .c100.p79 .bar:after, .c100.p79 .fill, .c100.p80 .bar:after, .c100.p80 .fill, .c100.p81 .bar:after, .c100.p81 .fill, .c100.p82 .bar:after, .c100.p82 .fill, .c100.p83 .bar:after, .c100.p83 .fill, .c100.p84 .bar:after, .c100.p84 .fill, .c100.p85 .bar:after, .c100.p85 .fill, .c100.p86 .bar:after, .c100.p86 .fill, .c100.p87 .bar:after, .c100.p87 .fill, .c100.p88 .bar:after, .c100.p88 .fill, .c100.p89 .bar:after, .c100.p89 .fill, .c100.p90 .bar:after, .c100.p90 .fill, .c100.p91 .bar:after, .c100.p91 .fill, .c100.p92 .bar:after, .c100.p92 .fill, .c100.p93 .bar:after, .c100.p93 .fill, .c100.p94 .bar:after, .c100.p94 .fill, .c100.p95 .bar:after, .c100.p95 .fill, .c100.p96 .bar:after, .c100.p96 .fill, .c100.p97 .bar:after, .c100.p97 .fill, .c100.p98 .bar:after, .c100.p98 .fill, .c100.p99 .bar:after, .c100.p99 .fill, .c100.p100 .bar:after, .c100.p100 .fill {
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}

.c100 {
  position: relative;
  font-size: 120px;
  width: 1em;
  height: 1em;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  -o-border-radius: 50%;
  border-radius: 50%;
  float: left;
  margin: 0 0.1em 0.1em 0;
  background-color: #cccccc;
}
.c100 *, .c100 *:before, .c100 *:after {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}
.c100.center {
  float: none;
  margin: 0 auto;
}
.c100.big {
  font-size: 240px;
}
.c100.small {
  font-size: 80px;
}
.c100 > span {
  position: absolute;
  width: 100%;
  z-index: 1;
  left: 0;
  top: 0;
  width: 5em;
  line-height: 5em;
  font-size: 0.2em;
  color: #cccccc;
  display: block;
  text-align: center;
  white-space: nowrap;
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: ease-out;
  -moz-transition-timing-function: ease-out;
  -o-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.c100:after {
  position: absolute;
  top: 0.08em;
  left: 0.08em;
  display: block;
  content: " ";
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  -o-border-radius: 50%;
  border-radius: 50%;
  background-color: whitesmoke;
  width: 0.84em;
  height: 0.84em;
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.2s;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -webkit-transition-timing-function: ease-in;
  -moz-transition-timing-function: ease-in;
  -o-transition-timing-function: ease-in;
  transition-timing-function: ease-in;
}
.c100 .slice {
  position: absolute;
  width: 1em;
  height: 1em;
  clip: rect(0em, 1em, 1em, 0.5em);
}
.c100.p1 .bar {
  -webkit-transform: rotate(3.6deg);
  -moz-transform: rotate(3.6deg);
  -ms-transform: rotate(3.6deg);
  -o-transform: rotate(3.6deg);
  transform: rotate(3.6deg);
}
.c100.p2 .bar {
  -webkit-transform: rotate(7.2deg);
  -moz-transform: rotate(7.2deg);
  -ms-transform: rotate(7.2deg);
  -o-transform: rotate(7.2deg);
  transform: rotate(7.2deg);
}
.c100.p3 .bar {
  -webkit-transform: rotate(10.8deg);
  -moz-transform: rotate(10.8deg);
  -ms-transform: rotate(10.8deg);
  -o-transform: rotate(10.8deg);
  transform: rotate(10.8deg);
}
.c100.p4 .bar {
  -webkit-transform: rotate(14.4deg);
  -moz-transform: rotate(14.4deg);
  -ms-transform: rotate(14.4deg);
  -o-transform: rotate(14.4deg);
  transform: rotate(14.4deg);
}
.c100.p5 .bar {
  -webkit-transform: rotate(18deg);
  -moz-transform: rotate(18deg);
  -ms-transform: rotate(18deg);
  -o-transform: rotate(18deg);
  transform: rotate(18deg);
}
.c100.p6 .bar {
  -webkit-transform: rotate(21.6deg);
  -moz-transform: rotate(21.6deg);
  -ms-transform: rotate(21.6deg);
  -o-transform: rotate(21.6deg);
  transform: rotate(21.6deg);
}
.c100.p7 .bar {
  -webkit-transform: rotate(25.2deg);
  -moz-transform: rotate(25.2deg);
  -ms-transform: rotate(25.2deg);
  -o-transform: rotate(25.2deg);
  transform: rotate(25.2deg);
}
.c100.p8 .bar {
  -webkit-transform: rotate(28.8deg);
  -moz-transform: rotate(28.8deg);
  -ms-transform: rotate(28.8deg);
  -o-transform: rotate(28.8deg);
  transform: rotate(28.8deg);
}
.c100.p9 .bar {
  -webkit-transform: rotate(32.4deg);
  -moz-transform: rotate(32.4deg);
  -ms-transform: rotate(32.4deg);
  -o-transform: rotate(32.4deg);
  transform: rotate(32.4deg);
}
.c100.p10 .bar {
  -webkit-transform: rotate(36deg);
  -moz-transform: rotate(36deg);
  -ms-transform: rotate(36deg);
  -o-transform: rotate(36deg);
  transform: rotate(36deg);
}
.c100.p11 .bar {
  -webkit-transform: rotate(39.6deg);
  -moz-transform: rotate(39.6deg);
  -ms-transform: rotate(39.6deg);
  -o-transform: rotate(39.6deg);
  transform: rotate(39.6deg);
}
.c100.p12 .bar {
  -webkit-transform: rotate(43.2deg);
  -moz-transform: rotate(43.2deg);
  -ms-transform: rotate(43.2deg);
  -o-transform: rotate(43.2deg);
  transform: rotate(43.2deg);
}
.c100.p13 .bar {
  -webkit-transform: rotate(46.8deg);
  -moz-transform: rotate(46.8deg);
  -ms-transform: rotate(46.8deg);
  -o-transform: rotate(46.8deg);
  transform: rotate(46.8deg);
}
.c100.p14 .bar {
  -webkit-transform: rotate(50.4deg);
  -moz-transform: rotate(50.4deg);
  -ms-transform: rotate(50.4deg);
  -o-transform: rotate(50.4deg);
  transform: rotate(50.4deg);
}
.c100.p15 .bar {
  -webkit-transform: rotate(54deg);
  -moz-transform: rotate(54deg);
  -ms-transform: rotate(54deg);
  -o-transform: rotate(54deg);
  transform: rotate(54deg);
}
.c100.p16 .bar {
  -webkit-transform: rotate(57.6deg);
  -moz-transform: rotate(57.6deg);
  -ms-transform: rotate(57.6deg);
  -o-transform: rotate(57.6deg);
  transform: rotate(57.6deg);
}
.c100.p17 .bar {
  -webkit-transform: rotate(61.2deg);
  -moz-transform: rotate(61.2deg);
  -ms-transform: rotate(61.2deg);
  -o-transform: rotate(61.2deg);
  transform: rotate(61.2deg);
}
.c100.p18 .bar {
  -webkit-transform: rotate(64.8deg);
  -moz-transform: rotate(64.8deg);
  -ms-transform: rotate(64.8deg);
  -o-transform: rotate(64.8deg);
  transform: rotate(64.8deg);
}
.c100.p19 .bar {
  -webkit-transform: rotate(68.4deg);
  -moz-transform: rotate(68.4deg);
  -ms-transform: rotate(68.4deg);
  -o-transform: rotate(68.4deg);
  transform: rotate(68.4deg);
}
.c100.p20 .bar {
  -webkit-transform: rotate(72deg);
  -moz-transform: rotate(72deg);
  -ms-transform: rotate(72deg);
  -o-transform: rotate(72deg);
  transform: rotate(72deg);
}
.c100.p21 .bar {
  -webkit-transform: rotate(75.6deg);
  -moz-transform: rotate(75.6deg);
  -ms-transform: rotate(75.6deg);
  -o-transform: rotate(75.6deg);
  transform: rotate(75.6deg);
}
.c100.p22 .bar {
  -webkit-transform: rotate(79.2deg);
  -moz-transform: rotate(79.2deg);
  -ms-transform: rotate(79.2deg);
  -o-transform: rotate(79.2deg);
  transform: rotate(79.2deg);
}
.c100.p23 .bar {
  -webkit-transform: rotate(82.8deg);
  -moz-transform: rotate(82.8deg);
  -ms-transform: rotate(82.8deg);
  -o-transform: rotate(82.8deg);
  transform: rotate(82.8deg);
}
.c100.p24 .bar {
  -webkit-transform: rotate(86.4deg);
  -moz-transform: rotate(86.4deg);
  -ms-transform: rotate(86.4deg);
  -o-transform: rotate(86.4deg);
  transform: rotate(86.4deg);
}
.c100.p25 .bar {
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
.c100.p26 .bar {
  -webkit-transform: rotate(93.6deg);
  -moz-transform: rotate(93.6deg);
  -ms-transform: rotate(93.6deg);
  -o-transform: rotate(93.6deg);
  transform: rotate(93.6deg);
}
.c100.p27 .bar {
  -webkit-transform: rotate(97.2deg);
  -moz-transform: rotate(97.2deg);
  -ms-transform: rotate(97.2deg);
  -o-transform: rotate(97.2deg);
  transform: rotate(97.2deg);
}
.c100.p28 .bar {
  -webkit-transform: rotate(100.8deg);
  -moz-transform: rotate(100.8deg);
  -ms-transform: rotate(100.8deg);
  -o-transform: rotate(100.8deg);
  transform: rotate(100.8deg);
}
.c100.p29 .bar {
  -webkit-transform: rotate(104.4deg);
  -moz-transform: rotate(104.4deg);
  -ms-transform: rotate(104.4deg);
  -o-transform: rotate(104.4deg);
  transform: rotate(104.4deg);
}
.c100.p30 .bar {
  -webkit-transform: rotate(108deg);
  -moz-transform: rotate(108deg);
  -ms-transform: rotate(108deg);
  -o-transform: rotate(108deg);
  transform: rotate(108deg);
}
.c100.p31 .bar {
  -webkit-transform: rotate(111.6deg);
  -moz-transform: rotate(111.6deg);
  -ms-transform: rotate(111.6deg);
  -o-transform: rotate(111.6deg);
  transform: rotate(111.6deg);
}
.c100.p32 .bar {
  -webkit-transform: rotate(115.2deg);
  -moz-transform: rotate(115.2deg);
  -ms-transform: rotate(115.2deg);
  -o-transform: rotate(115.2deg);
  transform: rotate(115.2deg);
}
.c100.p33 .bar {
  -webkit-transform: rotate(118.8deg);
  -moz-transform: rotate(118.8deg);
  -ms-transform: rotate(118.8deg);
  -o-transform: rotate(118.8deg);
  transform: rotate(118.8deg);
}
.c100.p34 .bar {
  -webkit-transform: rotate(122.4deg);
  -moz-transform: rotate(122.4deg);
  -ms-transform: rotate(122.4deg);
  -o-transform: rotate(122.4deg);
  transform: rotate(122.4deg);
}
.c100.p35 .bar {
  -webkit-transform: rotate(126deg);
  -moz-transform: rotate(126deg);
  -ms-transform: rotate(126deg);
  -o-transform: rotate(126deg);
  transform: rotate(126deg);
}
.c100.p36 .bar {
  -webkit-transform: rotate(129.6deg);
  -moz-transform: rotate(129.6deg);
  -ms-transform: rotate(129.6deg);
  -o-transform: rotate(129.6deg);
  transform: rotate(129.6deg);
}
.c100.p37 .bar {
  -webkit-transform: rotate(133.2deg);
  -moz-transform: rotate(133.2deg);
  -ms-transform: rotate(133.2deg);
  -o-transform: rotate(133.2deg);
  transform: rotate(133.2deg);
}
.c100.p38 .bar {
  -webkit-transform: rotate(136.8deg);
  -moz-transform: rotate(136.8deg);
  -ms-transform: rotate(136.8deg);
  -o-transform: rotate(136.8deg);
  transform: rotate(136.8deg);
}
.c100.p39 .bar {
  -webkit-transform: rotate(140.4deg);
  -moz-transform: rotate(140.4deg);
  -ms-transform: rotate(140.4deg);
  -o-transform: rotate(140.4deg);
  transform: rotate(140.4deg);
}
.c100.p40 .bar {
  -webkit-transform: rotate(144deg);
  -moz-transform: rotate(144deg);
  -ms-transform: rotate(144deg);
  -o-transform: rotate(144deg);
  transform: rotate(144deg);
}
.c100.p41 .bar {
  -webkit-transform: rotate(147.6deg);
  -moz-transform: rotate(147.6deg);
  -ms-transform: rotate(147.6deg);
  -o-transform: rotate(147.6deg);
  transform: rotate(147.6deg);
}
.c100.p42 .bar {
  -webkit-transform: rotate(151.2deg);
  -moz-transform: rotate(151.2deg);
  -ms-transform: rotate(151.2deg);
  -o-transform: rotate(151.2deg);
  transform: rotate(151.2deg);
}
.c100.p43 .bar {
  -webkit-transform: rotate(154.8deg);
  -moz-transform: rotate(154.8deg);
  -ms-transform: rotate(154.8deg);
  -o-transform: rotate(154.8deg);
  transform: rotate(154.8deg);
}
.c100.p44 .bar {
  -webkit-transform: rotate(158.4deg);
  -moz-transform: rotate(158.4deg);
  -ms-transform: rotate(158.4deg);
  -o-transform: rotate(158.4deg);
  transform: rotate(158.4deg);
}
.c100.p45 .bar {
  -webkit-transform: rotate(162deg);
  -moz-transform: rotate(162deg);
  -ms-transform: rotate(162deg);
  -o-transform: rotate(162deg);
  transform: rotate(162deg);
}
.c100.p46 .bar {
  -webkit-transform: rotate(165.6deg);
  -moz-transform: rotate(165.6deg);
  -ms-transform: rotate(165.6deg);
  -o-transform: rotate(165.6deg);
  transform: rotate(165.6deg);
}
.c100.p47 .bar {
  -webkit-transform: rotate(169.2deg);
  -moz-transform: rotate(169.2deg);
  -ms-transform: rotate(169.2deg);
  -o-transform: rotate(169.2deg);
  transform: rotate(169.2deg);
}
.c100.p48 .bar {
  -webkit-transform: rotate(172.8deg);
  -moz-transform: rotate(172.8deg);
  -ms-transform: rotate(172.8deg);
  -o-transform: rotate(172.8deg);
  transform: rotate(172.8deg);
}
.c100.p49 .bar {
  -webkit-transform: rotate(176.4deg);
  -moz-transform: rotate(176.4deg);
  -ms-transform: rotate(176.4deg);
  -o-transform: rotate(176.4deg);
  transform: rotate(176.4deg);
}
.c100.p50 .bar {
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}
.c100.p51 .bar {
  -webkit-transform: rotate(183.6deg);
  -moz-transform: rotate(183.6deg);
  -ms-transform: rotate(183.6deg);
  -o-transform: rotate(183.6deg);
  transform: rotate(183.6deg);
}
.c100.p52 .bar {
  -webkit-transform: rotate(187.2deg);
  -moz-transform: rotate(187.2deg);
  -ms-transform: rotate(187.2deg);
  -o-transform: rotate(187.2deg);
  transform: rotate(187.2deg);
}
.c100.p53 .bar {
  -webkit-transform: rotate(190.8deg);
  -moz-transform: rotate(190.8deg);
  -ms-transform: rotate(190.8deg);
  -o-transform: rotate(190.8deg);
  transform: rotate(190.8deg);
}
.c100.p54 .bar {
  -webkit-transform: rotate(194.4deg);
  -moz-transform: rotate(194.4deg);
  -ms-transform: rotate(194.4deg);
  -o-transform: rotate(194.4deg);
  transform: rotate(194.4deg);
}
.c100.p55 .bar {
  -webkit-transform: rotate(198deg);
  -moz-transform: rotate(198deg);
  -ms-transform: rotate(198deg);
  -o-transform: rotate(198deg);
  transform: rotate(198deg);
}
.c100.p56 .bar {
  -webkit-transform: rotate(201.6deg);
  -moz-transform: rotate(201.6deg);
  -ms-transform: rotate(201.6deg);
  -o-transform: rotate(201.6deg);
  transform: rotate(201.6deg);
}
.c100.p57 .bar {
  -webkit-transform: rotate(205.2deg);
  -moz-transform: rotate(205.2deg);
  -ms-transform: rotate(205.2deg);
  -o-transform: rotate(205.2deg);
  transform: rotate(205.2deg);
}
.c100.p58 .bar {
  -webkit-transform: rotate(208.8deg);
  -moz-transform: rotate(208.8deg);
  -ms-transform: rotate(208.8deg);
  -o-transform: rotate(208.8deg);
  transform: rotate(208.8deg);
}
.c100.p59 .bar {
  -webkit-transform: rotate(212.4deg);
  -moz-transform: rotate(212.4deg);
  -ms-transform: rotate(212.4deg);
  -o-transform: rotate(212.4deg);
  transform: rotate(212.4deg);
}
.c100.p60 .bar {
  -webkit-transform: rotate(216deg);
  -moz-transform: rotate(216deg);
  -ms-transform: rotate(216deg);
  -o-transform: rotate(216deg);
  transform: rotate(216deg);
}
.c100.p61 .bar {
  -webkit-transform: rotate(219.6deg);
  -moz-transform: rotate(219.6deg);
  -ms-transform: rotate(219.6deg);
  -o-transform: rotate(219.6deg);
  transform: rotate(219.6deg);
}
.c100.p62 .bar {
  -webkit-transform: rotate(223.2deg);
  -moz-transform: rotate(223.2deg);
  -ms-transform: rotate(223.2deg);
  -o-transform: rotate(223.2deg);
  transform: rotate(223.2deg);
}
.c100.p63 .bar {
  -webkit-transform: rotate(226.8deg);
  -moz-transform: rotate(226.8deg);
  -ms-transform: rotate(226.8deg);
  -o-transform: rotate(226.8deg);
  transform: rotate(226.8deg);
}
.c100.p64 .bar {
  -webkit-transform: rotate(230.4deg);
  -moz-transform: rotate(230.4deg);
  -ms-transform: rotate(230.4deg);
  -o-transform: rotate(230.4deg);
  transform: rotate(230.4deg);
}
.c100.p65 .bar {
  -webkit-transform: rotate(234deg);
  -moz-transform: rotate(234deg);
  -ms-transform: rotate(234deg);
  -o-transform: rotate(234deg);
  transform: rotate(234deg);
}
.c100.p66 .bar {
  -webkit-transform: rotate(237.6deg);
  -moz-transform: rotate(237.6deg);
  -ms-transform: rotate(237.6deg);
  -o-transform: rotate(237.6deg);
  transform: rotate(237.6deg);
}
.c100.p67 .bar {
  -webkit-transform: rotate(241.2deg);
  -moz-transform: rotate(241.2deg);
  -ms-transform: rotate(241.2deg);
  -o-transform: rotate(241.2deg);
  transform: rotate(241.2deg);
}
.c100.p68 .bar {
  -webkit-transform: rotate(244.8deg);
  -moz-transform: rotate(244.8deg);
  -ms-transform: rotate(244.8deg);
  -o-transform: rotate(244.8deg);
  transform: rotate(244.8deg);
}
.c100.p69 .bar {
  -webkit-transform: rotate(248.4deg);
  -moz-transform: rotate(248.4deg);
  -ms-transform: rotate(248.4deg);
  -o-transform: rotate(248.4deg);
  transform: rotate(248.4deg);
}
.c100.p70 .bar {
  -webkit-transform: rotate(252deg);
  -moz-transform: rotate(252deg);
  -ms-transform: rotate(252deg);
  -o-transform: rotate(252deg);
  transform: rotate(252deg);
}
.c100.p71 .bar {
  -webkit-transform: rotate(255.6deg);
  -moz-transform: rotate(255.6deg);
  -ms-transform: rotate(255.6deg);
  -o-transform: rotate(255.6deg);
  transform: rotate(255.6deg);
}
.c100.p72 .bar {
  -webkit-transform: rotate(259.2deg);
  -moz-transform: rotate(259.2deg);
  -ms-transform: rotate(259.2deg);
  -o-transform: rotate(259.2deg);
  transform: rotate(259.2deg);
}
.c100.p73 .bar {
  -webkit-transform: rotate(262.8deg);
  -moz-transform: rotate(262.8deg);
  -ms-transform: rotate(262.8deg);
  -o-transform: rotate(262.8deg);
  transform: rotate(262.8deg);
}
.c100.p74 .bar {
  -webkit-transform: rotate(266.4deg);
  -moz-transform: rotate(266.4deg);
  -ms-transform: rotate(266.4deg);
  -o-transform: rotate(266.4deg);
  transform: rotate(266.4deg);
}
.c100.p75 .bar {
  -webkit-transform: rotate(270deg);
  -moz-transform: rotate(270deg);
  -ms-transform: rotate(270deg);
  -o-transform: rotate(270deg);
  transform: rotate(270deg);
}
.c100.p76 .bar {
  -webkit-transform: rotate(273.6deg);
  -moz-transform: rotate(273.6deg);
  -ms-transform: rotate(273.6deg);
  -o-transform: rotate(273.6deg);
  transform: rotate(273.6deg);
}
.c100.p77 .bar {
  -webkit-transform: rotate(277.2deg);
  -moz-transform: rotate(277.2deg);
  -ms-transform: rotate(277.2deg);
  -o-transform: rotate(277.2deg);
  transform: rotate(277.2deg);
}
.c100.p78 .bar {
  -webkit-transform: rotate(280.8deg);
  -moz-transform: rotate(280.8deg);
  -ms-transform: rotate(280.8deg);
  -o-transform: rotate(280.8deg);
  transform: rotate(280.8deg);
}
.c100.p79 .bar {
  -webkit-transform: rotate(284.4deg);
  -moz-transform: rotate(284.4deg);
  -ms-transform: rotate(284.4deg);
  -o-transform: rotate(284.4deg);
  transform: rotate(284.4deg);
}
.c100.p80 .bar {
  -webkit-transform: rotate(288deg);
  -moz-transform: rotate(288deg);
  -ms-transform: rotate(288deg);
  -o-transform: rotate(288deg);
  transform: rotate(288deg);
}
.c100.p81 .bar {
  -webkit-transform: rotate(291.6deg);
  -moz-transform: rotate(291.6deg);
  -ms-transform: rotate(291.6deg);
  -o-transform: rotate(291.6deg);
  transform: rotate(291.6deg);
}
.c100.p82 .bar {
  -webkit-transform: rotate(295.2deg);
  -moz-transform: rotate(295.2deg);
  -ms-transform: rotate(295.2deg);
  -o-transform: rotate(295.2deg);
  transform: rotate(295.2deg);
}
.c100.p83 .bar {
  -webkit-transform: rotate(298.8deg);
  -moz-transform: rotate(298.8deg);
  -ms-transform: rotate(298.8deg);
  -o-transform: rotate(298.8deg);
  transform: rotate(298.8deg);
}
.c100.p84 .bar {
  -webkit-transform: rotate(302.4deg);
  -moz-transform: rotate(302.4deg);
  -ms-transform: rotate(302.4deg);
  -o-transform: rotate(302.4deg);
  transform: rotate(302.4deg);
}
.c100.p85 .bar {
  -webkit-transform: rotate(306deg);
  -moz-transform: rotate(306deg);
  -ms-transform: rotate(306deg);
  -o-transform: rotate(306deg);
  transform: rotate(306deg);
}
.c100.p86 .bar {
  -webkit-transform: rotate(309.6deg);
  -moz-transform: rotate(309.6deg);
  -ms-transform: rotate(309.6deg);
  -o-transform: rotate(309.6deg);
  transform: rotate(309.6deg);
}
.c100.p87 .bar {
  -webkit-transform: rotate(313.2deg);
  -moz-transform: rotate(313.2deg);
  -ms-transform: rotate(313.2deg);
  -o-transform: rotate(313.2deg);
  transform: rotate(313.2deg);
}
.c100.p88 .bar {
  -webkit-transform: rotate(316.8deg);
  -moz-transform: rotate(316.8deg);
  -ms-transform: rotate(316.8deg);
  -o-transform: rotate(316.8deg);
  transform: rotate(316.8deg);
}
.c100.p89 .bar {
  -webkit-transform: rotate(320.4deg);
  -moz-transform: rotate(320.4deg);
  -ms-transform: rotate(320.4deg);
  -o-transform: rotate(320.4deg);
  transform: rotate(320.4deg);
}
.c100.p90 .bar {
  -webkit-transform: rotate(324deg);
  -moz-transform: rotate(324deg);
  -ms-transform: rotate(324deg);
  -o-transform: rotate(324deg);
  transform: rotate(324deg);
}
.c100.p91 .bar {
  -webkit-transform: rotate(327.6deg);
  -moz-transform: rotate(327.6deg);
  -ms-transform: rotate(327.6deg);
  -o-transform: rotate(327.6deg);
  transform: rotate(327.6deg);
}
.c100.p92 .bar {
  -webkit-transform: rotate(331.2deg);
  -moz-transform: rotate(331.2deg);
  -ms-transform: rotate(331.2deg);
  -o-transform: rotate(331.2deg);
  transform: rotate(331.2deg);
}
.c100.p93 .bar {
  -webkit-transform: rotate(334.8deg);
  -moz-transform: rotate(334.8deg);
  -ms-transform: rotate(334.8deg);
  -o-transform: rotate(334.8deg);
  transform: rotate(334.8deg);
}
.c100.p94 .bar {
  -webkit-transform: rotate(338.4deg);
  -moz-transform: rotate(338.4deg);
  -ms-transform: rotate(338.4deg);
  -o-transform: rotate(338.4deg);
  transform: rotate(338.4deg);
}
.c100.p95 .bar {
  -webkit-transform: rotate(342deg);
  -moz-transform: rotate(342deg);
  -ms-transform: rotate(342deg);
  -o-transform: rotate(342deg);
  transform: rotate(342deg);
}
.c100.p96 .bar {
  -webkit-transform: rotate(345.6deg);
  -moz-transform: rotate(345.6deg);
  -ms-transform: rotate(345.6deg);
  -o-transform: rotate(345.6deg);
  transform: rotate(345.6deg);
}
.c100.p97 .bar {
  -webkit-transform: rotate(349.2deg);
  -moz-transform: rotate(349.2deg);
  -ms-transform: rotate(349.2deg);
  -o-transform: rotate(349.2deg);
  transform: rotate(349.2deg);
}
.c100.p98 .bar {
  -webkit-transform: rotate(352.8deg);
  -moz-transform: rotate(352.8deg);
  -ms-transform: rotate(352.8deg);
  -o-transform: rotate(352.8deg);
  transform: rotate(352.8deg);
}
.c100.p99 .bar {
  -webkit-transform: rotate(356.4deg);
  -moz-transform: rotate(356.4deg);
  -ms-transform: rotate(356.4deg);
  -o-transform: rotate(356.4deg);
  transform: rotate(356.4deg);
}
.c100.p100 .bar {
  -webkit-transform: rotate(360deg);
  -moz-transform: rotate(360deg);
  -ms-transform: rotate(360deg);
  -o-transform: rotate(360deg);
  transform: rotate(360deg);
}
.c100:hover {
  cursor: default;
}
.c100:hover > span {
  width: 3.33em;
  line-height: 3.33em;
  font-size: 0.3em;
  color: #307bbb;
}
.c100:hover:after {
  top: 0.04em;
  left: 0.04em;
  width: 0.92em;
  height: 0.92em;
}
.c100.dark {
  background-color: #777777;
}
.c100.dark .bar,
.c100.dark .fill {
  border-color: #c6ff00 !important;
}
.c100.dark > span {
  color: #777777;
}
.c100.dark:after {
  background-color: #666666;
}
.c100.dark:hover > span {
  color: #c6ff00;
}
.c100.green .bar, .c100.green .fill {
  border-color: #4db53c !important;
}
.c100.green:hover > span {
  color: #4db53c;
}
.c100.green.dark .bar, .c100.green.dark .fill {
  border-color: #5fd400 !important;
}
.c100.green.dark:hover > span {
  color: #5fd400;
}
.c100.orange .bar, .c100.orange .fill {
  border-color: #dd9d22 !important;
}
.c100.orange:hover > span {
  color: #dd9d22;
}
.c100.orange.dark .bar, .c100.orange.dark .fill {
  border-color: #e08833 !important;
}
.c100.orange.dark:hover > span {
  color: #e08833;
}

.plane_stats{
    width: 40px;
    height: auto;
    position: relative;
    top: 15px;
    left: 5px;
}
.heli_stats{
    width: 40px;
    height: auto;
    position: relative;
    top: 70px;
    left: 12px;
}
.heli_text{
    font-weight: bold;
    position: relative;
    top: 95px;
    right: 68px;
    color: #ed1c24;
}
.plane_text{
    font-weight: bold;
    position: relative;
    top: 0px;
    right: 38px;
    color: #ed1c24;
}
.adc_wrapper{
    font-weight: bold;
    position: relative;
    top: 65px;
    right: -18px;
}
.adc_wrapper_text{
    font-weight: bold;
    position: relative;
    top: 82px;
    right: 6px;
}
.navlog_wrapper{
    font-weight: bold;
    position: relative;
    top: 60px;
    right: -86px;
}
.navlog_wrapper_text{
    font-weight: bold;
    position: relative;
    top: 80px;
    right: -45px;
}
.wx_wrapper{
    font-weight: bold;
    position: relative;
    top: 174px;
    right: 118px;
}
.wx_wrapper_notoms{
    font-weight: bold;
    position: relative;
    top: 175px;
    right: 12px;
}
.wx_wrapper_number{
    font-weight: bold;
    position: relative;
    top: 175px;
    right: 12px;
}
</style>
@include('includes.new_header',[])
<div class="row mainrow">
   <div class="container">
      <div class="col-md-2">
         <!--<div class="donut-chart-block block">
            <div class="donut-chart">
               <div id="porcion1" class="recorte">
                  <div class="quesito ios" data-rel="21"></div>
               </div>
               <div id="porcionFin" class="recorte">
                  <div class="quesito linux" data-rel="9"></div>
               </div>
               <p class="center-date">1</p>
            </div>
         </div>-->
         <div class="c100 p50">
            <span>50%</span>
            <div class="slice">
                <div class="bar" style="border: 0.08em solid #4ac4cf;"></div>
                <div class="fill"></div>
            </div>
         </div>
         <p class="titular">TOTAL PLANS</p>
      </div>
      <div class="col-md-2">
         <!--<div class="donut-chart2-block block">
            <div class="donut-chart2">
               <div id="porcion1" class="recorte2">
                  <div class="quesito2 ios" data-rel="21"></div>
               </div>
               <div id="porcionFin2" class="recorte2">
                  <div class="quesito2 linux" data-rel="9"></div>
               </div>
               <p class="center-date2">2</p>
            </div>
         </div>-->
         <div class="c100 p30">
            <span>30%</span>
            <div class="slice">
                <div class="bar" style="border: 0.08em solid #e57c8d;"></div>
                <div class="fill"></div>
            </div>
         </div>
         <p class="titular2">THIS YEAR</p>
      </div>
      <div class="col-md-2">
         <!--<div class="donut-chart3-block block">
            <div class="donut-chart3">
               <div id="porcion1" class="recorte3">
                  <div class="quesito3 ios" data-rel="21"></div>
               </div>
               <div id="porcionFin3" class="recorte2">
                  <div class="quesito3 linux" data-rel="9"></div>
               </div>
               <p class="center-date3">3</p>
            </div>
         </div>-->
         <div class="c100 p10">
            <span>10%</span>
            <div class="slice">
                <div class="bar" style="border: 0.08em solid #a3c377;"></div>
                <div class="fill"></div>
            </div>
         </div>
         <p class="titular3">THIS MONTH</p>
      </div>
      <div class="col-md-2">
         <!--<div class="donut-chart4-block block">
            <div class="donut-chart4">
               <div id="porcion1" class="recorte4">
                  <div class="quesito4 ios" data-rel="21"></div>
               </div>
               <div id="porcionFin4" class="recorte4">
                  <div class="quesito4 linux" data-rel="9"></div>
               </div>
               <p class="center-date4">4</p>
            </div>
         </div>-->
         <div class="c100 p70">
            <span>70%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
         </div>
         <p class="titular4">TODAY</p>
      </div>
      <div class="col-md-2">
         <!--<div class="donut-chart5-block block">
            <div class="donut-chart5">
               <div id="porcion1" class="recorte5">
                  <div class="quesito5 ios" data-rel="21"></div>
               </div>
               <div id="porcionFin5" class="recorte5">
                  <div class="quesito5 linux" data-rel="9"></div>
               </div>
               <p class="center-date5">5</p>
            </div>
         </div>-->
         <div class="c100 p50">
            <span>50%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
         </div>
         <p class="titular5">YESTERDAY</p>
      </div>
      <div class="col-md-2">
         <!--<div class="donut-chart6-block block">
            <div class="donut-chart6">
               <div id="porcion1" class="recorte6">
                  <div class="quesito6 ios" data-rel="21"></div>
               </div>
               <div id="porcionFin6" class="recorte6">
                  <div class="quesito6 linux" data-rel="9"></div>
               </div>
               <p class="center-date6">6</p>
            </div>
         </div>-->
         <div class="c100 p10">
            <span>10%</span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
         </div>
         <p class="titular6">TOMORROW</p>
      </div>
   </div>
   <!--container close here-->
</div>
<!--row close here-->
<div class="row mainrow">
   <div class="col-md-6">
      <div class="col-md-12">
         <p class="statsheader" style="background: #cacaca;">STATS</p>
      </div>
      <div class="col-md-12">
         <div class="col-md-6 seven_wrapper_main" style="padding:45px 0px 50px 0px;">
               <!--<div class="donut-chart7-block block">
                  <div class="donut-chart7">
                     <div id="porcion1" class="recorte7">
                        <div class="quesito7 ios" data-rel="21"></div>
                     </div>
                     <div id="porcionFin7" class="recorte7">
                        <div class="quesito7 linux" data-rel="9"></div>
                     </div>
                     <p class="center-date7">7</p>
                  </div>
               </div>-->
               <img class="heli_stats" src="{{'app/new_temp/images/helicopter.png'}}"/>
               <img class="plane_stats" src="{{'app/new_temp/images/Airplane.png'}}" />
               <span class="heli_text">5</span>
               <span class="plane_text">5</span>
                <div class="c100 p10" style="margin-left:24%;font-size:133px;">
                    <span>110/10</span>
                    <div class="slice">
                        <div class="bar" style="border: 0.08em solid #ffbf00;"></div>
                        <div class="fill"></div>
                    </div>
                </div>
         </div>
         <div class="col-md-6 eight_wrapper_main" style="padding: 5px 0px 50px 0px;">
               <!--<div class="donut-chart8-block block">
                  <div class="donut-chart8">
                     <div id="porcion1" class="recorte8">
                        <div class="quesito8 ios" data-rel="21"></div>
                     </div>
                     <div id="porcionFin8" class="recorte8">
                        <div class="quesito8 linux" data-rel="9"></div>
                     </div>
                     <p class="center-date8">8</p>
                  </div>
               </div>-->
               <span class="adc_wrapper">ADC</span>
               <span class="adc_wrapper_text">5</span>
               <span class="navlog_wrapper">NAV LOG</span>
               <span class="navlog_wrapper_text">20</span>
               <span class="wx_wrapper">WX</span>
               <span class="wx_wrapper_notoms">NOTOMS</span>
               <span class="wx_wrapper_number">30</span>
              <div class="c100 p100" style="margin-left: 15%;margin-top: 30px;font-size:133px;">
                    <!--<span>50%</span>-->
                    <div class="slice">
                        <div class="bar" style="border: 0.08em solid #ffbf00;transform: rotate(270deg);"></div>
                        <div class="bar" style="border: 0.08em solid #caaadb;transform: rotate(90deg);"></div>
                        <div class="fill"></div>
                    </div>
                </div>
         </div>
      </div>
   </div>
   <div class="col-md-3" style="padding:0px;">
     <div class="col-md-12" style="background:#cacaca;">
         <p class="statsheader">TOP 5 CLIENTS</p>
      </div>
      <div class="col-md-12" style="background: #fff;">
         <p>1</p>
         <p>2</p>
         <p>3</p>
         <p>4</p>
         <p>5</p>
      </div>

      <div class="col-md-12" style="background:#cacaca;">
         <p class="statsheader">TOP 5 AIRPORTS</p>
      </div>
      <div class="col-md-12" style="background: #fff;">
         <p>1</p>
         <p>2</p>
         <p>3</p>
         <p>4</p>
         <p>5</p>
      </div>
   </div>
   <div class="col-md-3">
     <div class="col-md-12" style="background:#cacaca;">
         <p class="statsheader">ADC DELAYED PLANS</p>
      </div>
      <div class="col-md-12 adc_delayed_wrapper" style="background: #fff;">
         <p>1</p>
         <p>2</p>
         <p>3</p>
         <p>4</p>
         <p>5</p>
         <p>6</p>
         <p>7</p>
         <p>8</p>
         <p>9</p>
         <p>10</p>
      </div>
   </div>
</div><!--row mainrow close here-->
<div class="row">
<div class="container last_sub_main_wrapper">
<div class="col-md-12">
<div class="col-md-2 client_sub_wrapper">
<p class="client_sub">CLIENTS</p>

</div>
<div class="col-md-2 ">
<p class="client_sub">FIXED WING</p>

</div>
<div class="col-md-2">
<p class="client_sub">HELICOPTER</p>

</div>
<div class="col-md-2">
<p class="client_sub">WEBSITE</p>

</div>
<div class="col-md-2">
<p class="client_sub">APP</p>

</div>
<div class="col-md-2 eflight_sub_wrapper">
<p class="client_sub">EFLIGHT</p>

</div>

</div><!--col-md-12 close here-->
</div><!--container close here-->
</div><!--row mainrow close here-->

@include('includes.new_footer',[])
@stop