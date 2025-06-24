import Swiper from 'swiper';

/******
Swiper Javscript modules - LET OP: Zet enkel de modules aan die je nodig hebt voor betere perfomance:
******/

// import { Virtual } from 'swiper/modules';
import { Keyboard } from 'swiper/modules';
// import { Mousewheel } from 'swiper/modules';
import { Navigation } from 'swiper/modules';
import { Pagination } from 'swiper/modules';
// import { Scrollbar } from 'swiper/modules';
// import { Parallax } from 'swiper/modules';
// import { FreeMode } from 'swiper/modules';
// import { Grid } from 'swiper/modules';
// import { Manipulation } from 'swiper/modules';
// import { Zoom } from 'swiper/modules';
import { Controller } from 'swiper/modules';
import { A11y } from 'swiper/modules';
// import { History } from 'swiper/modules';
// import { HashNavigation } from 'swiper/modules';
import { Autoplay } from 'swiper/modules';
import { EffectFade } from 'swiper/modules';
// import { EffectCube } from 'swiper/modules';
// import { EffectFlip } from 'swiper/modules';
// import { EffectCoverflow } from 'swiper/modules';
// import { EffectCards } from 'swiper/modules';
// import { EffectCreative } from 'swiper/modules';
// import { Thumbs } from 'swiper/modules';

/******
Swiper CSS modules - LET OP: Zet enkel de modules aan die je nodig hebt voor betere perfomance:
******/

import 'swiper/css'; // default Swiper CSS
import 'swiper/css/a11y';
import 'swiper/css/autoplay';
import 'swiper/css/controller';
// import 'swiper/css/effect-cards';
// import 'swiper/css/effect-coverflow';
// import 'swiper/css/effect-creative';
// import 'swiper/css/effect-cube';
import 'swiper/css/effect-fade';
// import 'swiper/css/effect-flip';
// import 'swiper/css/free-mode';
// import 'swiper/css/grid';
// import 'swiper/css/hash-navigation';
// import 'swiper/css/history';
import 'swiper/css/keyboard';
// import 'swiper/css/manipulation';
// import 'swiper/css/mousewheel';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
// import 'swiper/css/parallax';
// import 'swiper/css/scrollbar';
// import 'swiper/css/thumbs';
// import 'swiper/css/virtual';
// import 'swiper/css/zoom';

// Voeg de modules toe aan Swiper
Swiper.use([Keyboard, Navigation, Pagination, Controller, A11y, Autoplay, EffectFade]);

// Maak Swiper variable globaal beschikbaar:
window.Swiper = Swiper;