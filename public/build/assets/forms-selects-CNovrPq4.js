$(function(){const i=$(".selectpicker"),l=$(".select2"),c=$(".select2-icons");if(i.length&&i.selectpicker(),l.length&&l.each(function(){var e=$(this);e.wrap('<div class="position-relative"></div>').select2({placeholder:"Select value",dropdownParent:e.parent()})}),c.length){let e=function(t){if(!t.id)return t.text;var n="<i class='"+$(t.element).data("icon")+" me-2'></i>"+t.text;return n};var s=e;c.wrap('<div class="position-relative"></div>').select2({dropdownParent:c.parent(),templateResult:e,templateSelection:e,escapeMarkup:function(t){return t}})}});
