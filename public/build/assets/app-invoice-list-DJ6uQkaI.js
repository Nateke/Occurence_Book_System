$(function(){var l=$(".invoice-list-table");if(l.length)var p=l.DataTable({ajax:assetsPath+"json/invoice-list.json",columns:[{data:""},{data:"invoice_id"},{data:"invoice_status"},{data:"issued_date"},{data:"client_name"},{data:"total"},{data:"balance"},{data:"invoice_status"},{data:"action"}],columnDefs:[{className:"control",responsivePriority:2,searchable:!1,targets:0,render:function(t,s,a,n){return""}},{targets:1,render:function(t,s,a,n){var e=a.invoice_id,i='<a href="'+baseUrl+'app/invoice/preview">#'+e+"</a>";return i}},{targets:2,render:function(t,s,a,n){var e=a.invoice_status,i=a.due_date,o=a.balance,d={Sent:'<span class="badge badge-center rounded-pill bg-label-secondary w-px-30 h-px-30"><i class="ti ti-circle-check ti-sm"></i></span>',Draft:'<span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30"><i class="ti ti-device-floppy ti-sm"></i></span>',"Past Due":'<span class="badge badge-center rounded-pill bg-label-danger w-px-30 h-px-30"><i class="ti ti-info-circle ti-sm"></i></span>',"Partial Payment":'<span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30"><i class="ti ti-circle-half-2 ti-sm"></i></span>',Paid:'<span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30"><i class="ti ti-chart-pie ti-sm"></i></span>',Downloaded:'<span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30"><i class="ti ti-arrow-down-circle ti-sm"></i></span>'};return"<span data-bs-toggle='tooltip' data-bs-html='true' title='<span>"+e+'<br> <span class="fw-medium">Balance:</span> '+o+'<br> <span class="fw-medium">Due Date:</span> '+i+"</span>'>"+d[e]+"</span>"}},{targets:3,responsivePriority:4,render:function(t,s,a,n){var e=a.client_name,i=a.service,o=a.avatar_image,d=Math.floor(Math.random()*11)+1,m=d+".png";if(o===!0)var c='<img src="'+assetsPath+"img/avatars/"+m+'" alt="Avatar" class="rounded-circle">';else{var u=Math.floor(Math.random()*6),v=["success","danger","warning","info","primary","secondary"],b=v[u],e=a.client_name,r=e.match(/\b\w/g)||[];r=((r.shift()||"")+(r.pop()||"")).toUpperCase(),c='<span class="avatar-initial rounded-circle bg-label-'+b+'">'+r+"</span>"}var f='<div class="d-flex justify-content-start align-items-center"><div class="avatar-wrapper"><div class="avatar me-2">'+c+'</div></div><div class="d-flex flex-column"><a href="'+baseUrl+'pages/profile-user" class="text-body text-truncate"><span class="fw-medium">'+e+'</span></a><small class="text-truncate text-muted">'+i+"</small></div></div>";return f}},{targets:4,render:function(t,s,a,n){var e=a.total;return'<span class="d-none">'+e+"</span>$"+e}},{targets:5,render:function(t,s,a,n){var e=new Date(a.due_date),i='<span class="d-none">'+moment(e).format("YYYYMMDD")+"</span>"+moment(e).format("DD MMM YYYY");return i}},{targets:6,orderable:!1,render:function(t,s,a,n){var e=a.balance;if(e===0){var i="bg-label-success";return'<span class="badge '+i+'" text-capitalized> Paid </span>'}else return'<span class="d-none">'+e+"</span>"+e}},{targets:7,visible:!1},{targets:-1,title:"Actions",searchable:!1,orderable:!1,render:function(t,s,a,n){return'<div class="d-flex align-items-center"><a href="javascript:;" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Send Mail"><i class="ti ti-mail mx-2 ti-sm"></i></a><a href="'+baseUrl+'app/invoice/preview" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Preview Invoice"><i class="ti ti-eye mx-2 ti-sm"></i></a><div class="dropdown"><a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm"></i></a><div class="dropdown-menu dropdown-menu-end"><a href="javascript:;" class="dropdown-item">Download</a><a href="'+baseUrl+'app/invoice/edit" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item delete-record text-danger">Delete</a></div></div></div>'}}],order:[[1,"desc"]],dom:'<"row mx-1"<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>><"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"invoice_status mb-3 mb-md-0">>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',language:{sLengthMenu:"Show _MENU_",search:"",searchPlaceholder:"Search Invoice"},buttons:[{text:'<i class="ti ti-plus me-md-1"></i><span class="d-md-inline-block d-none">Create Invoice</span>',className:"btn btn-primary waves-effect waves-light",action:function(t,s,a,n){window.location=baseUrl+"app/invoice/add"}}],responsive:{details:{display:$.fn.dataTable.Responsive.display.modal({header:function(t){var s=t.data();return"Details of "+s.full_name}}),type:"column",renderer:function(t,s,a){var n=$.map(a,function(e,i){return e.title!==""?'<tr data-dt-row="'+e.rowIndex+'" data-dt-column="'+e.columnIndex+'"><td>'+e.title+":</td> <td>"+e.data+"</td></tr>":""}).join("");return n?$('<table class="table"/><tbody />').append(n):!1}}},initComplete:function(){this.api().columns(7).every(function(){var t=this,s=$('<select id="UserRole" class="form-select"><option value=""> Select Status </option></select>').appendTo(".invoice_status").on("change",function(){var a=$.fn.dataTable.util.escapeRegex($(this).val());t.search(a?"^"+a+"$":"",!0,!1).draw()});t.data().unique().sort().each(function(a,n){s.append('<option value="'+a+'" class="text-capitalize">'+a+"</option>")})})}});l.on("draw.dt",function(){var t=[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));t.map(function(s){return new bootstrap.Tooltip(s,{boundary:document.body})})}),$(".invoice-list-table tbody").on("click",".delete-record",function(){p.row($(this).parents("tr")).remove().draw()}),setTimeout(()=>{$(".dataTables_filter .form-control").removeClass("form-control-sm"),$(".dataTables_length .form-select").removeClass("form-select-sm")},300)});
