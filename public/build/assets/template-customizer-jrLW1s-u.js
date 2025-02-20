const z=`<div id="template-customizer" class="invert-bg-white">
  <a href="javascript:void(0)" class="template-customizer-open-btn" tabindex="-1"></a>

  <div class="p-4 m-0 lh-1 border-bottom template-customizer-header position-relative py-3">
    <h4 class="template-customizer-t-panel_header mb-2"></h4>
    <p class="template-customizer-t-panel_sub_header mb-0"></p>
    <div class="d-flex align-items-center gap-2 position-absolute end-0 top-0 mt-4 me-3">
      <a
        href="javascript:void(0)"
        class="template-customizer-reset-btn text-body"
        data-bs-toggle="tooltip"
        data-bs-placement="bottom"
        title="Reset Customizer"
        ><i class="ti ti-refresh ti-sm"></i
        ><span class="badge rounded-pill bg-danger badge-dot badge-notifications d-none"></span
      ></a>
      <a href="javascript:void(0)" class="template-customizer-close-btn fw-light text-body" tabindex="-1"
        ><i class="ti ti-x ti-sm"></i
      ></a>
    </div>
  </div>

  <div class="template-customizer-inner pt-4">
    <!-- Theming -->
    <div class="template-customizer-theming">
      <h5 class="m-0 px-4 py-4 lh-1 d-block">
        <span class="template-customizer-t-theming_header bg-label-primary rounded-1 py-1 px-2 fs-big"></span>
      </h5>

      <!-- Style -->
      <div class="m-0 px-4 pb-3 pt-1 template-customizer-style w-100">
        <label for="customizerStyle" class="form-label d-block template-customizer-t-style_label"></label>
        <div class="row px-1 template-customizer-styles-options"></div>
      </div>

      <!-- Themes -->
      <div class="m-0 px-4 pt-3 template-customizer-themes w-100">
        <label for="customizerTheme" class="form-label template-customizer-t-theme_label"></label>
        <div class="row px-1 template-customizer-themes-options"></div>
      </div>
    </div>
    <!--/ Theming -->

    <!-- Layout -->
    <div class="template-customizer-layout">
      <hr class="m-0 px-4 my-4" />
      <h5 class="m-0 px-4 pb-4 pt-2 d-block">
        <span class="template-customizer-t-layout_header bg-label-primary rounded-1 py-1 px-2 fs-big"></span>
      </h5>

      <!-- Layout(Menu) -->
      <div class="m-0 px-4 pb-3 d-block template-customizer-layouts">
        <label for="customizerStyle" class="form-label d-block template-customizer-t-layout_label"></label>
        <div class="row px-1 template-customizer-layouts-options">
          <!--? Uncomment If using offcanvas layout -->
          <!-- <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="layoutRadios" id="layoutRadios-offcanvas"
                value="static-offcanvas">
              <label class="form-check-label template-customizer-t-layout_offcanvas"
                for="layoutRadios-offcanvas"></label>
            </div>
          </div> -->
          <!-- <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="layoutRadios" id="layoutRadios-fixed_offcanvas"
                value="fixed-offcanvas">
              <label class="form-check-label template-customizer-t-layout_fixed_offcanvas"
                for="layoutRadios-fixed_offcanvas"></label>
            </div>
          </div> -->
        </div>
      </div>

      <!-- Header Options for Horizontal -->
      <div class="m-0 px-4 pb-3 template-customizer-headerOptions w-100">
        <label for="customizerHeader" class="form-label template-customizer-t-layout_header_label"></label>
        <div class="row px-1 template-customizer-header-options"></div>
      </div>

      <!-- Fixed navbar -->
      <div class="m-0 px-4 pb-3 template-customizer-layoutNavbarOptions w-100">
        <label for="customizerNavbar" class="form-label template-customizer-t-layout_navbar_label"></label>
        <div class="row px-1 template-customizer-navbar-options"></div>
      </div>

      <!-- Content -->
      <div class="m-0 px-4 pb-3 template-customizer-content w-100">
        <label for="customizerContent" class="form-label template-customizer-t-content_label"></label>
        <div class="row px-1 template-customizer-content-options"></div>
      </div>

      <!-- Directions -->
      <div class="m-0 px-4 pb-3 template-customizer-directions w-100">
        <label for="customizerDirection" class="form-label template-customizer-t-direction_label"></label>
        <div class="row px-1 template-customizer-directions-options"></div>
      </div>
    </div>
    <!--/ Layout -->
  </div>
</div>
`,A="%name%.scss",D=["rtl","style","headerType","contentLayout","layoutCollapsed","showDropdownOnHover","layoutNavbarOptions","layoutFooterFixed","themes"],F=["light","dark","system"],R=["sticky","static","hidden"];let O;const g=document.documentElement.classList;g.contains("layout-navbar-fixed")?O="sticky":g.contains("layout-navbar-hidden")?O="hidden":O="static";const H=!0,$=document.getElementsByTagName("HTML")[0].getAttribute("data-theme")||0,q=g.contains("dark-style")?"dark":"light",I=document.documentElement.getAttribute("dir")==="rtl",P=!!g.contains("layout-menu-collapsed"),M=!0,B=O,U=g.contains("layout-wide")?"wide":"compact",W=!!g.contains("layout-footer-fixed");let E;g.contains("layout-menu-offcanvas")?E="static-offcanvas":g.contains("layout-menu-fixed")?E="fixed":g.contains("layout-menu-fixed-offcanvas")?E="fixed-offcanvas":E="static";const Y=E;class m{constructor({cssPath:t,themesPath:e,cssFilenamePattern:s,displayCustomizer:i,controls:d,defaultTextDir:_,defaultHeaderType:r,defaultContentLayout:l,defaultMenuCollapsed:u,defaultShowDropdownOnHover:p,defaultNavbarType:h,defaultFooterFixed:S,styles:T,navbarOptions:w,defaultStyle:L,availableContentLayouts:a,availableDirections:c,availableStyles:f,availableThemes:C,availableLayouts:v,availableHeaderTypes:k,availableNavbarOptions:o,defaultTheme:y,pathResolver:n,onSettingsChange:b,lang:x}){if(!this._ssr){if(!window.Helpers)throw new Error("window.Helpers required.");if(this.settings={},this.settings.cssPath=t,this.settings.themesPath=e,this.settings.cssFilenamePattern=s||A,this.settings.displayCustomizer=typeof i<"u"?i:H,this.settings.controls=d||D,this.settings.defaultTextDir=_==="rtl"?!0:I,this.settings.defaultHeaderType=r||Y,this.settings.defaultMenuCollapsed=typeof u<"u"?u:P,this.settings.defaultContentLayout=typeof l<"u"?l:U,this.settings.defaultShowDropdownOnHover=typeof p<"u"?p:M,this.settings.defaultNavbarType=typeof h<"u"?h:B,this.settings.defaultFooterFixed=typeof S<"u"?S:W,this.settings.availableDirections=c||m.DIRECTIONS,this.settings.availableStyles=f||m.STYLES,this.settings.availableThemes=C||m.THEMES,this.settings.availableHeaderTypes=k||m.HEADER_TYPES,this.settings.availableContentLayouts=a||m.CONTENT,this.settings.availableLayouts=v||m.LAYOUTS,this.settings.availableNavbarOptions=o||m.NAVBAR_OPTIONS,this.settings.defaultTheme=this._getDefaultTheme(typeof y<"u"?y:$),this.settings.styles=T||F,this.settings.navbarOptions=w||R,this.settings.defaultStyle=L||q,this.settings.lang=x||"en",this.pathResolver=n||(N=>N),this.settings.styles.length<2){const N=this.settings.controls.indexOf("style");N!==-1&&(this.settings.controls=this.settings.controls.slice(0,N).concat(this.settings.controls.slice(N+1)))}this.settings.onSettingsChange=typeof b=="function"?b:()=>{},this._loadSettings(),this._listeners=[],this._controls={},this._initDirection(),this._initStyle(),this._initTheme(),this.setLayoutType(this.settings.headerType,!1),this.setContentLayout(this.settings.contentLayout,!1),this.setDropdownOnHover(this.settings.showDropdownOnHover,!1),this.setLayoutNavbarOption(this.settings.layoutNavbarOptions,!1),this.setLayoutFooterFixed(this.settings.layoutFooterFixed,!1),this._setup()}}setRtl(t){this._hasControls("rtl")&&(this._setSetting("Rtl",String(t)),window.location.reload())}setContentLayout(t,e=!0){this._hasControls("contentLayout")&&(this.settings.contentLayout=t,e&&this._setSetting("contentLayout",t),window.Helpers.setContentLayout(t),e&&this.settings.onSettingsChange.call(this,this.settings))}setStyle(t){this._setSetting("Style",t),t!==""&&this._checkCookie("mode")?t==="system"?(this._setCookie("mode","system",365),window.matchMedia("(prefers-color-scheme: dark)").matches?this._setCookie("colorPref","dark",365):this._setCookie("colorPref","light",365)):t==="dark"?this._setCookie("mode","dark",365):this._setCookie("mode","light",365):this._setCookie("mode",t||"light",365),window.location.reload()}setTheme(t,e=!0,s=null){if(!this._hasControls("themes"))return;const i=this._getThemeByName(t);if(!i)return;this.settings.theme=i,e&&this._setSetting("Theme",t),this._setCookie("theme",t,365);const d=this.pathResolver(this.settings.themesPath+this.settings.cssFilenamePattern.replace("%name%",t+(this.settings.style!=="light"?`-${this.settings.style}`:"")));this._loadStylesheets({[d]:document.querySelector(".template-customizer-theme-css")},s||(()=>{})),e&&this.settings.onSettingsChange.call(this,this.settings)}setLayoutType(t,e=!0){if(!this._hasControls("headerType")||t!=="static"&&t!=="static-offcanvas"&&t!=="fixed"&&t!=="fixed-offcanvas")return;this.settings.headerType=t,e&&this._setSetting("LayoutType",t),window.Helpers.setPosition(t==="fixed"||t==="fixed-offcanvas",t==="static-offcanvas"||t==="fixed-offcanvas"),e&&this.settings.onSettingsChange.call(this,this.settings);let s=window.Helpers.menuPsScroll;const i=window.PerfectScrollbar;this.settings.headerType==="fixed"||this.settings.headerType==="fixed-offcanvas"?i&&s&&(window.Helpers.menuPsScroll.destroy(),s=new i(document.querySelector(".menu-inner"),{suppressScrollX:!0,wheelPropagation:!1}),window.Helpers.menuPsScroll=s):s&&window.Helpers.menuPsScroll.destroy()}setDropdownOnHover(t,e=!0){if(this._hasControls("showDropdownOnHover")){if(this.settings.showDropdownOnHover=t,e&&this._setSetting("ShowDropdownOnHover",t),window.Helpers.mainMenu){window.Helpers.mainMenu.destroy(),config.showDropdownOnHover=t;const{Menu:s}=window;window.Helpers.mainMenu=new s(document.getElementById("layout-menu"),{orientation:"horizontal",closeChildren:!0,showDropdownOnHover:config.showDropdownOnHover})}e&&this.settings.onSettingsChange.call(this,this.settings)}}setLayoutNavbarOption(t,e=!0){this._hasControls("layoutNavbarOptions")&&(this.settings.layoutNavbarOptions=t,e&&this._setSetting("FixedNavbarOption",t),window.Helpers.setNavbar(t),e&&this.settings.onSettingsChange.call(this,this.settings))}setLayoutFooterFixed(t,e=!0){this.settings.layoutFooterFixed=t,e&&this._setSetting("FixedFooter",t),window.Helpers.setFooterFixed(t),e&&this.settings.onSettingsChange.call(this,this.settings)}setLang(t,e=!0,s=!1){if(t===this.settings.lang&&!s)return;if(!m.LANGUAGES[t])throw new Error(`Language "${t}" not found!`);const i=m.LANGUAGES[t];["panel_header","panel_sub_header","theming_header","style_label","style_switch_light","style_switch_dark","layout_header","layout_label","layout_header_label","content_label","layout_static","layout_offcanvas","layout_fixed","layout_fixed_offcanvas","layout_dd_open_label","layout_navbar_label","layout_footer_label","misc_header","theme_label","direction_label"].forEach(r=>{const l=this.container.querySelector(`.template-customizer-t-${r}`);l&&(l.textContent=i[r])});const d=i.themes||{},_=this.container.querySelectorAll(".template-customizer-theme-item")||[];for(let r=0,l=_.length;r<l;r++){const u=_[r].querySelector('input[type="radio"]').value;_[r].querySelector(".template-customizer-theme-name").textContent=d[u]||this._getThemeByName(u).title}this.settings.lang=t,e&&this._setSetting("Lang",t),e&&this.settings.onSettingsChange.call(this,this.settings)}update(){if(this._ssr)return;const t=!!document.querySelector(".layout-navbar"),e=!!document.querySelector(".layout-menu"),s=!!document.querySelector(".layout-menu-horizontal.menu, .layout-menu-horizontal .menu");document.querySelector(".layout-wrapper.layout-navbar-full");const i=!!document.querySelector(".content-footer");this._controls.showDropdownOnHover&&(e?(this._controls.showDropdownOnHover.setAttribute("disabled","disabled"),this._controls.showDropdownOnHover.classList.add("disabled")):(this._controls.showDropdownOnHover.removeAttribute("disabled"),this._controls.showDropdownOnHover.classList.remove("disabled"))),this._controls.layoutNavbarOptions&&(t?(this._controls.layoutNavbarOptions.removeAttribute("disabled"),this._controls.layoutNavbarOptionsW.classList.remove("disabled")):(this._controls.layoutNavbarOptions.setAttribute("disabled","disabled"),this._controls.layoutNavbarOptionsW.classList.add("disabled")),s&&t&&this.settings.headerType==="fixed"&&(this._controls.layoutNavbarOptions.setAttribute("disabled","disabled"),this._controls.layoutNavbarOptionsW.classList.add("disabled"))),this._controls.layoutFooterFixed&&(i?(this._controls.layoutFooterFixed.removeAttribute("disabled"),this._controls.layoutFooterFixedW.classList.remove("disabled")):(this._controls.layoutFooterFixed.setAttribute("disabled","disabled"),this._controls.layoutFooterFixedW.classList.add("disabled"))),this._controls.headerType&&(e||s?this._controls.headerType.removeAttribute("disabled"):this._controls.headerType.setAttribute("disabled","disabled"))}clearLocalStorage(){if(this._ssr)return;const t=this._getLayoutName();["Theme","Style","LayoutCollapsed","FixedNavbarOption","LayoutType","contentLayout","Rtl","Lang"].forEach(s=>{const i=`templateCustomizer-${t}--${s}`;localStorage.removeItem(i)}),this._showResetBtnNotification(!1)}destroy(){this._ssr||(this._cleanup(),this.settings=null,this.container.parentNode.removeChild(this.container),this.container=null)}_loadSettings(){const t=this._getSetting("Rtl"),e=this._getSetting("Style"),s=this._getSetting("Theme"),i=this._getSetting("contentLayout"),d=this._getSetting("LayoutCollapsed"),_=this._getSetting("ShowDropdownOnHover"),r=this._getSetting("FixedNavbarOption"),l=this._getSetting("FixedFooter"),u=this._getSetting("LayoutType");t!==""||e!==""||s!==""||i!==""||d!==""||r!==""||u!==""?this._showResetBtnNotification(!0):this._showResetBtnNotification(!1);let p;u!==""&&["static","static-offcanvas","fixed","fixed-offcanvas"].indexOf(u)!==-1?p=u:p=this.settings.defaultHeaderType,this.settings.headerType=p,this.settings.rtl=t!==""?t==="true":this.settings.defaultTextDir,this.settings.stylesOpt=this.settings.styles.indexOf(e)!==-1?e:this.settings.defaultStyle,this._getCookie("mode")==="system"?window.matchMedia("(prefers-color-scheme: dark)").matches?(this._setCookie("colorPref","dark",365),this.settings.style="dark"):(this._setCookie("colorPref","light",365),this.settings.style="light"):this.settings.stylesOpt==="system"?window.matchMedia("(prefers-color-scheme: dark)").matches?this.settings.style="dark":this.settings.style="light":this.settings.style=this.settings.styles.indexOf(e)!==-1?e:this.settings.stylesOpt,this.settings.contentLayout=i!==""?i:this.settings.defaultContentLayout,this.settings.layoutCollapsed=d!==""?d==="true":this.settings.defaultMenuCollapsed,this.settings.showDropdownOnHover=_!==""?_==="true":this.settings.defaultShowDropdownOnHover;let h;r!==""&&["static","sticky","hidden"].indexOf(r)!==-1?h=r:h=this.settings.defaultNavbarType,this.settings.layoutNavbarOptions=h,this.settings.layoutFooterFixed=l!==""?l==="true":this.settings.defaultFooterFixed,this._checkCookie("theme")?this.settings.theme=this._getThemeByName(this._getCookie("theme"),!0):this.settings.theme=this._getThemeByName(this._getSetting("Theme"),!0),this._hasControls("rtl")||(this.settings.rtl=document.documentElement.getAttribute("dir")==="rtl"),this._hasControls("style")||(this.settings.style=g.contains("dark-style")?"dark":"light"),this._hasControls("contentLayout")||(this.settings.contentLayout=null),this._hasControls("headerType")||(this.settings.headerType=null),this._hasControls("layoutCollapsed")||(this.settings.layoutCollapsed=null),this._hasControls("layoutNavbarOptions")||(this.settings.layoutNavbarOptions=null),this._hasControls("themes")||(this.settings.theme=null)}_setup(t=document){const e=(a,c,f,C,v)=>(v=v||a,this._getElementFromString(`<div class="col-4 px-2">
      <div class="form-check custom-option custom-option-icon mb-0">
        <label class="form-check-label custom-option-content p-0" for="${f}${a}">
          <span class="custom-option-body mb-0">
            <img src="${assetsPath}img/customizer/${v}${C?"-dark":""}.svg" alt="${c}" class="img-fluid scaleX-n1-rtl" />
          </span>
          <input
            name="${f}"
            class="form-check-input d-none"
            type="radio"
            value="${a}"
            id="${f}${a}" />
        </label>
      </div>
      <label class="form-check-label small text-nowrap" for="${f}${a}">${c}</label>
    </div>`));this._cleanup(),this.container=this._getElementFromString(z);const s=this.container;this.settings.displayCustomizer?s.setAttribute("style","visibility: visible"):s.setAttribute("style","visibility: hidden");const i=this.container.querySelector(".template-customizer-open-btn"),d=()=>{this.container.classList.add("template-customizer-open"),this.update(),this._updateInterval&&clearInterval(this._updateInterval),this._updateInterval=setInterval(()=>{this.update()},500)};i.addEventListener("click",d),this._listeners.push([i,"click",d]);const _=this.container.querySelector(".template-customizer-reset-btn"),r=()=>{this.clearLocalStorage(),window.location.reload(),this._deleteCookie("mode"),this._deleteCookie("colorPref"),this._deleteCookie("theme")};_.addEventListener("click",r),this._listeners.push([_,"click",r]);const l=this.container.querySelector(".template-customizer-close-btn"),u=()=>{this.container.classList.remove("template-customizer-open"),this._updateInterval&&(clearInterval(this._updateInterval),this._updateInterval=null)};l.addEventListener("click",u),this._listeners.push([l,"click",u]);const p=this.container.querySelector(".template-customizer-style"),h=p.querySelector(".template-customizer-styles-options");if(!this._hasControls("style"))p.parentNode.removeChild(p);else{this.settings.availableStyles.forEach(c=>{const f=e(c.name,c.title,"customRadioIcon",g.contains("dark-style"));h.appendChild(f)}),h.querySelector(`input[value="${this.settings.stylesOpt}"]`).setAttribute("checked","checked");const a=c=>{this._loadingState(!0),this.setStyle(c.target.value,!0,()=>{this._loadingState(!1)})};h.addEventListener("change",a),this._listeners.push([h,"change",a])}const S=this.container.querySelector(".template-customizer-themes"),T=S.querySelector(".template-customizer-themes-options");if(!this._hasControls("themes"))S.parentNode.removeChild(S);else{this.settings.availableThemes.forEach(c=>{let f="";c.name==="theme-semi-dark"?f="semi-dark":c.name==="theme-bordered"?f="border":f="default";const C=e(c.name,c.title,"themeRadios",g.contains("dark-style"),f);T.appendChild(C)}),T.querySelector(`input[value="${this.settings.theme.name}"]`).setAttribute("checked","checked");const a=c=>{this._loading=!0,this._loadingState(!0,!0),this.setTheme(c.target.value,!0,()=>{this._loading=!1,this._loadingState(!1,!0)})};T.addEventListener("change",a),this._listeners.push([T,"change",a])}const w=this.container.querySelector(".template-customizer-theming");!this._hasControls("style")&&!this._hasControls("themes")&&w.parentNode.removeChild(w);const L=this.container.querySelector(".template-customizer-layout");if(!this._hasControls("rtl headerType contentLayout layoutCollapsed layoutNavbarOptions",!0))L.parentNode.removeChild(L);else{const a=this.container.querySelector(".template-customizer-directions");if(!this._hasControls("rtl")||!rtlSupport)a.parentNode.removeChild(a);else{const o=a.querySelector(".template-customizer-directions-options");this.settings.availableDirections.forEach(n=>{const b=e(n.name,n.title,"directionRadioIcon",g.contains("dark-style"));o.appendChild(b)}),o.querySelector(`input[value="${this.settings.rtl?"rtl":"ltr"}"]`).setAttribute("checked","checked");const y=n=>{this._loadingState(!0),this.setRtl(n.target.value==="rtl",!0,()=>{this._loadingState(!1)}),n.target.value==="rtl"?window.location.href=baseUrl+"lang/ar":window.location.href=baseUrl+"lang/en"};o.addEventListener("change",y),this._listeners.push([o,"change",y])}const c=this.container.querySelector(".template-customizer-headerOptions"),f=document.documentElement.getAttribute("data-template").split("-");if(!this._hasControls("headerType"))c.parentNode.removeChild(c);else{const o=c.querySelector(".template-customizer-header-options");setTimeout(()=>{f.includes("vertical")&&c.parentNode.removeChild(c)},100),this.settings.availableHeaderTypes.forEach(n=>{const b=e(n.name,n.title,"headerRadioIcon",g.contains("dark-style"),`horizontal-${n.name}`);o.appendChild(b)}),o.querySelector(`input[value="${this.settings.headerType}"]`).setAttribute("checked","checked");const y=n=>{this.setLayoutType(n.target.value)};o.addEventListener("change",y),this._listeners.push([o,"change",y])}const C=this.container.querySelector(".template-customizer-content");if(!this._hasControls("contentLayout"))C.parentNode.removeChild(C);else{const o=C.querySelector(".template-customizer-content-options");this.settings.availableContentLayouts.forEach(n=>{const b=e(n.name,n.title,"contentRadioIcon",g.contains("dark-style"));o.appendChild(b)}),o.querySelector(`input[value="${this.settings.contentLayout}"]`).setAttribute("checked","checked");const y=n=>{this._loading=!0,this._loadingState(!0,!0),this.setContentLayout(n.target.value,!0,()=>{this._loading=!1,this._loadingState(!1,!0)})};o.addEventListener("change",y),this._listeners.push([o,"change",y])}const v=this.container.querySelector(".template-customizer-layouts");if(!this._hasControls("layoutCollapsed"))v.parentNode.removeChild(v);else{setTimeout(()=>{document.querySelector(".layout-menu-horizontal")&&v.parentNode.removeChild(v)},100);const o=v.querySelector(".template-customizer-layouts-options");this.settings.availableLayouts.forEach(n=>{const b=e(n.name,n.title,"layoutsRadios",g.contains("dark-style"));o.appendChild(b)}),o.querySelector(`input[value="${this.settings.layoutCollapsed?"collapsed":"expanded"}"]`).setAttribute("checked","checked");const y=n=>{window.Helpers.setCollapsed(n.target.value==="collapsed",!0),this._setSetting("LayoutCollapsed",n.target.value==="collapsed")};o.addEventListener("change",y),this._listeners.push([o,"change",y])}const k=this.container.querySelector(".template-customizer-layoutNavbarOptions");if(!this._hasControls("layoutNavbarOptions"))k.parentNode.removeChild(k);else{setTimeout(()=>{f.includes("horizontal")&&k.parentNode.removeChild(k)},100);const o=k.querySelector(".template-customizer-navbar-options");this.settings.availableNavbarOptions.forEach(n=>{const b=e(n.name,n.title,"navbarOptionRadios",g.contains("dark-style"));o.appendChild(b)}),o.querySelector(`input[value="${this.settings.layoutNavbarOptions}"]`).setAttribute("checked","checked");const y=n=>{this._loading=!0,this._loadingState(!0,!0),this.setLayoutNavbarOption(n.target.value,!0,()=>{this._loading=!1,this._loadingState(!1,!0)})};o.addEventListener("change",y),this._listeners.push([o,"change",y])}}setTimeout(()=>{const a=this.container.querySelector(".template-customizer-layout");document.querySelector(".menu-vertical")?this._hasControls("rtl contentLayout layoutCollapsed layoutNavbarOptions",!0)||a&&a.parentNode.removeChild(a):document.querySelector(".menu-horizontal")&&(this._hasControls("rtl contentLayout headerType",!0)||a&&a.parentNode.removeChild(a))},100),this.setLang(this.settings.lang,!1,!0),t===document?t.body?t.body.appendChild(this.container):window.addEventListener("DOMContentLoaded",()=>t.body.appendChild(this.container)):t.appendChild(this.container)}_initDirection(){this._hasControls("rtl")&&document.documentElement.setAttribute("dir",this.settings.rtl?"rtl":"ltr")}_initStyle(){if(!this._hasControls("style"))return;const{style:t}=this.settings;this._insertStylesheet("template-customizer-core-css",this.pathResolver(this.settings.cssPath+this.settings.cssFilenamePattern.replace("%name%",`core${t!=="light"?`-${t}`:""}`))),(t==="light"?["dark-style"]:["light-style"]).forEach(s=>{document.documentElement.classList.remove(s)}),document.documentElement.classList.add(`${t}-style`)}_initTheme(){if(this._hasControls("themes"))this._insertStylesheet("template-customizer-theme-css",this.pathResolver(this.settings.themesPath+this.settings.cssFilenamePattern.replace("%name%",this.settings.theme.name+(this.settings.style!=="light"?`-${this.settings.style}`:""))));else{const t=this._getSetting("Theme");this._insertStylesheet("template-customizer-theme-css",this.pathResolver(this.settings.themesPath+this.settings.cssFilenamePattern.replace("%name%",t||this.settings.defaultTheme.name+(this.settings.style!=="light"?`-${this.settings.style}`:""))))}}_loadStylesheet(t,e){const s=document.createElement("link");s.rel="stylesheet",s.type="text/css",s.href=t,s.className=e,document.head.appendChild(s)}_insertStylesheet(t,e){const s=document.querySelector(`.${t}`);if(typeof document.documentMode=="number"&&document.documentMode<11){if(!s||e===s.getAttribute("href"))return;const i=document.createElement("link");i.setAttribute("rel","stylesheet"),i.setAttribute("type","text/css"),i.className=t,i.setAttribute("href",e),s.parentNode.insertBefore(i,s.nextSibling)}else this._loadStylesheet(e,t);s&&s.parentNode.removeChild(s)}_loadStylesheets(t,e){const s=Object.keys(t),i=s.length;let d=0;function _(l,u,p=()=>{}){const h=document.createElement("link");h.setAttribute("href",l),h.setAttribute("rel","stylesheet"),h.setAttribute("type","text/css"),h.className=u.className;const S="sheet"in h?"sheet":"styleSheet",T="sheet"in h?"cssRules":"rules";let w;const L=setTimeout(()=>{clearInterval(w),clearTimeout(L),u.parentNode.removeChild(h),p(!1,l)},15e3);w=setInterval(()=>{try{h[S]&&h[S][T].length&&(clearInterval(w),clearTimeout(L),u.parentNode.removeChild(u),p(!0))}catch{}},10),u.setAttribute("href",h.href)}function r(){(d+=1)>=i&&e()}for(let l=0;l<s.length;l++)_(s[l],t[s[l]],r())}_loadingState(t,e){this.container.classList[t?"add":"remove"](`template-customizer-loading${e?"-theme":""}`)}_getElementFromString(t){const e=document.createElement("div");return e.innerHTML=t,e.firstChild}_getSetting(t){let e=null;const s=this._getLayoutName();try{e=localStorage.getItem(`templateCustomizer-${s}--${t}`)}catch{}return String(e||"")}_showResetBtnNotification(t=!0){setTimeout(()=>{const e=this.container.querySelector(".template-customizer-reset-btn .badge");t?e.classList.remove("d-none"):e.classList.add("d-none")},200)}_setSetting(t,e){const s=this._getLayoutName();try{localStorage.setItem(`templateCustomizer-${s}--${t}`,String(e)),this._showResetBtnNotification()}catch{}}_getLayoutName(){return document.getElementsByTagName("HTML")[0].getAttribute("data-template")}_removeListeners(){for(let t=0,e=this._listeners.length;t<e;t++)this._listeners[t][0].removeEventListener(this._listeners[t][1],this._listeners[t][2])}_cleanup(){this._removeListeners(),this._listeners=[],this._controls={},this._updateInterval&&(clearInterval(this._updateInterval),this._updateInterval=null)}get _ssr(){return typeof window>"u"}_hasControls(t,e=!1){return t.split(" ").reduce((s,i)=>(this.settings.controls.indexOf(i)!==-1?(e||s!==!1)&&(s=!0):(!e||s!==!0)&&(s=!1),s),null)}_getDefaultTheme(t){let e;if(typeof t=="string"?e=this._getThemeByName(t,!1):e=this.settings.availableThemes[t],!e)throw new Error(`Theme ID "${t}" not found!`);return e}_getThemeByName(t,e=!1){const s=this.settings.availableThemes;for(let i=0,d=s.length;i<d;i++)if(s[i].name===t)return s[i];return e?this.settings.defaultTheme:null}_setCookie(t,e,s,i="/",d=""){const _=`${encodeURIComponent(t)}=${encodeURIComponent(e)}`;let r="";if(s){const p=new Date;p.setTime(p.getTime()+s*24*60*60*1e3),r=`; expires=${p.toUTCString()}`}const l=`; path=${i}`,u=d?`; domain=${d}`:"";document.cookie=`${_}${r}${l}${u}`}_getCookie(t){const e=document.cookie.split("; ");for(let s=0;s<e.length;s++){const[i,d]=e[s].split("=");if(decodeURIComponent(i)===t)return decodeURIComponent(d)}return null}_checkCookie(t){return this._getCookie(t)!==null}_deleteCookie(t){document.cookie=t+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"}}m.STYLES=[{name:"light",title:"Light"},{name:"dark",title:"Dark"},{name:"system",title:"System"}];m.THEMES=[{name:"theme-default",title:"Default"},{name:"theme-bordered",title:"Bordered"},{name:"theme-semi-dark",title:"Semi Dark"}];m.LAYOUTS=[{name:"expanded",title:"Expanded"},{name:"collapsed",title:"Collapsed"}];m.NAVBAR_OPTIONS=[{name:"sticky",title:"Sticky"},{name:"static",title:"Static"},{name:"hidden",title:"Hidden"}];m.HEADER_TYPES=[{name:"fixed",title:"Fixed"},{name:"static",title:"Static"}];m.CONTENT=[{name:"compact",title:"Compact"},{name:"wide",title:"Wide"}];m.DIRECTIONS=[{name:"ltr",title:"Left to Right (En)"},{name:"rtl",title:"Right to Left (Ar)"}];m.LANGUAGES={en:{panel_header:"Template Customizer",panel_sub_header:"Customize and preview in real time",theming_header:"Theming",style_label:"Style (Mode)",theme_label:"Themes",layout_header:"Layout",layout_label:"Menu (Navigation)",layout_header_label:"Header Types",content_label:"Content",layout_navbar_label:"Navbar Type",direction_label:"Direction"},fr:{panel_header:"Modèle De Personnalisation",panel_sub_header:"Personnalisez et prévisualisez en temps réel",theming_header:"Thématisation",style_label:"Style (Mode)",theme_label:"Thèmes",layout_header:"Disposition",layout_label:"Menu (Navigation)",layout_header_label:"Types d'en-tête",content_label:"Contenu",layout_navbar_label:"Type de barre de navigation",direction_label:"Direction"},ar:{panel_header:"أداة تخصيص القالب",panel_sub_header:"تخصيص ومعاينة في الوقت الحقيقي",theming_header:"السمات",style_label:"النمط (الوضع)",theme_label:"المواضيع",layout_header:"تَخطِيط",layout_label:"القائمة (الملاحة)",layout_header_label:"أنواع الرأس",content_label:"محتوى",layout_navbar_label:"نوع شريط التنقل",direction_label:"اتجاه"},de:{panel_header:"Vorlagen-Anpasser",panel_sub_header:"Anpassen und Vorschau in Echtzeit",theming_header:"Themen",style_label:"Stil (Modus)",theme_label:"Themen",layout_header:"Layout",layout_label:"Menü (Navigation)",layout_header_label:"Header-Typen",content_label:"Inhalt",layout_navbar_label:"Art der Navigationsleiste",direction_label:"Richtung"}};window.TemplateCustomizer=m;
