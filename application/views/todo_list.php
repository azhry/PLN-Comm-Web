<style type="text/css">
		body .legitRipple-ripple {
		  background: rgba(0,0,0,0.17);
		}
		#rc-context-menu {
		  padding: 6px 0;
		  /*max-width: 240px;*/
		  /*max-height: 320px;*/
		  opacity: 1;
		  z-index: 100000;
		  position: absolute;
		  left: -1000%;
		  overflow-X: hidden;
		  overflow-Y: auto;
		  white-space: nowrap;
		  background: #fff;
		  box-shadow: 0 2px 4px 1px rgba(0,0,0,0.1), 0 0 20px rgba(0,0,0,0.1);
		  margin: 1px;
		  transition: max-width 0.5s -0.1s, max-height 0.5s -0.1s, opacity 0.5s;
		  user-select: none;
		}
		#rc-context-menu.hidden {
		  max-width: 0;
		  max-height: 0;
		  opacity: 0.3;
		  overflow: hidden;
		  transition: max-width 0.2s 0.2s, max-height 0.2s 0.2s, opacity 0.5s 0.2s;
		}
		#rc-context-menu i {
		  color: #333;
		}
		#rc-context-menu .menu-item {
		  padding: 12px 24px 12px 30px;
		  min-width: 198px;
		  width: 100%;
		  font-size: 15px;
		  height: 40px;
		  position: relative;
		  overflow: hidden;
		  color: #333;
		  box-shadow: 4px 0 rgba(0,0,0,0) inset;
		  cursor: pointer;
		  transition: all 0.2s, background 0.5s, box-shadow 0.5s;
		}
		#rc-context-menu .menu-item div {
		  display: inline-block;
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  padding: 12px 24px 12px 48px;
		}
		#rc-context-menu .menu-item i {
		  display: inline-block;
		  position: absolute;
		  top: 8px;
		  left: 16px;
		}
		#rc-context-menu .menu-item:hover {
		  background-color: rgba(0,0,0,0.2);
		  box-shadow: 4px 0 rgba(0,0,0,0.25) inset;
		}
		#rc-context-menu .menu-item:active {
		  background-color: rgba(0,0,0,0.25);
		  box-shadow: 4px 0 rgba(0,0,0,0.4) inset;
		}
		#rc-context-menu:not(.hidden) .icon-group {
		  flex-wrap: wrap;
		}
		#rc-context-menu .icon-group {
		  width: 100%;
		  display: flex;
		}
		#rc-context-menu .icon-group .menu-icon {
		  display: inline-flex;
		  flex-grow: 1;
		  padding: 12px;
		  min-width: 16px;
		  height: 16px;
		  font-size: 15px;
		  position: relative;
		  overflow: hidden;
		  color: #333;
		  cursor: pointer;
		  transition: all 0.2s;
		}
		#rc-context-menu .icon-group .menu-icon:hover {
		  background: rgba(0,0,0,0.17);
		}
		#rc-context-menu .icon-group .menu-icon:active {
		  background: rgba(0,0,0,0.25);
		}
		#rc-context-menu .icon-group .menu-icon i {
		  position: absolute;
		  top: 8px;
		  left: -1px;
		  width: 100%;
		  text-align: center;
		}
		#rc-context-menu .icon-group .menu-icon.flex-only {
		  display: none;
		}
		#flex-example:checked ~ #rc-context-menu .flex-only {
		  display: inline-block;
		}
		#rc-context-menu .separator {
		  width: 100%;
		  height: 1px;
		  background: rgba(0,0,0,0.17);
		  padding: 0;
		  margin: 8px 0;
		}
		#rc-context-menu .label {
		  padding: 2px 16px;
		  display: block;
		  font-size: 15px;
		  color: #424242;
		  cursor: default;
		}
		@media (pointer: fine) {
		  #rc-context-menu::-webkit-scrollbar {
		    width: 12px;
		    background: #fff;
		    box-shadow: -1px 0 rgba(0,0,0,0.1);
		  }
		  #rc-context-menu::-webkit-scrollbar-corner {
		    background: transparent;
		  }
		  #rc-context-menu::-webkit-scrollbar-track {
		    background-clip: padding-box;
		    border: solid transparent;
		    border-width: 0 0 0 4px;
		  }
		  #rc-context-menu::-webkit-scrollbar-button {
		    height: 0;
		    width: 0;
		  }
		  #rc-context-menu::-webkit-scrollbar-thumb {
		    background-color: rgba(0,0,0,0.2);
		    background-clip: padding-box;
		    border: solid transparent;
		    border-width: 1px 1px 1px 1px;
		    min-height: 28px;
		    padding: 100px 0 0;
		    box-shadow: 1px 1px 0 rgba(0,0,0,0.1) inset, 0 -1px 0 rgba(0,0,0,0.07) inset;
		  }
		  #rc-context-menu::-webkit-scrollbar-thumb:hover {
		    background-color: rgba(0,0,0,0.37);
		    box-shadow: 1px 1px 0 rgba(0,0,0,0.21) inset, 0 -1px 0 rgba(0,0,0,0.17) inset;
		  }
		  #rc-context-menu::-webkit-scrollbar-thumb:active {
		    background-color: rgba(0,0,0,0.5);
		    box-shadow: 1px 1px 0 rgba(0,0,0,0.41) inset, 0 -1px 0 rgba(0,0,0,0.37) inset;
		  }
		}
		/*
		legitRipple.js v1.0.0, Copyright by Matthias Vogt (ISC license)
		ripple.min.css, compiled: 12/10/2015 @ 0:29:21
		*/
		.legitRipple {
		  position: relative;
		  overflow: hidden;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		  z-index: 0;
		}
		.legitRipple.longOpacity .legitRipple-ripple {
		  -webkit-transition-duration: 0.15s, 3.6s;
		  transition-duration: 0.15s, 3.6s;
		}
		.legitRipple.longDrop .legitRipple-ripple {
		  -webkit-transition-duration: 0.75s, 0.9s;
		  transition-duration: 0.75s, 0.9s;
		  -webkit-transition-timing-function: linear, cubic-bezier(1, 0, 0.8, 0);
		  transition-timing-function: linear, cubic-bezier(1, 0, 0.8, 0);
		}
		.legitRipple.longOpacity.longDrop .legitRipple-ripple {
		  -webkit-transition-duration: 0.75s, 3.6s;
		  transition-duration: 0.75s, 3.6s;
		  -webkit-transition-timing-function: linear, cubic-bezier(1, 0, 0.8, 0);
		  transition-timing-function: linear, cubic-bezier(1, 0, 0.8, 0);
		}
		.legitRipple-ripple {
		  position: absolute;
		  z-index: -1;
		  -webkit-transform: translate(-50%, -50%) scale(1);
		  transform: translate(-50%, -50%) scale(1);
		  -webkit-transition: width 0.15s linear, opacity 0.9s ease-out;
		  transition: width 0.15s linear, opacity 0.9s ease-out;
		  width: 0;
		  opacity: 1;
		  pointer-events: none;
		  border-radius: 50%;
		  background: rgba(255,255,255,0.4);
		}
		.legitRipple-ripple:before {
		  content: "";
		  padding-top: 100%;
		  display: block;
		}
		img~.legitRipple-ripple {
		  z-index: 0;
		}
		.legitRipple-custom {
		  display: none;
		}
		.legitRipple-custom~.legitRipple-ripple {
		  display: inline-block;
		  overflow: hidden;
		}
		.legitRipple-custom~.legitRipple-ripple>* {
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  min-width: 100%;
		  min-height: 100%;
		  -webkit-transform: translate(-50%, -50%);
		  transform: translate(-50%, -50%);
		}
	.context-label {
		margin-left: 20px;
	}

	.list:hover {
		background-color: rgba(0, 0, 0, 0.1);
		cursor: pointer;
	}

	#item-list {
		overflow-y: auto;
		-webkit-overflow-y: auto;
		background-image: url('<?= base_url('img/background.jpg?1') ?>');
		background-position: center;
	    background-repeat: no-repeat;
	    background-size: cover;
	    padding-left: 16px;
	    padding-right: 16px;
	}

	.completed-todo-item-title {
		text-decoration: line-through;
	}

	.uncompleted-todo-item-title {
		color: #555;
	}

	#ongoing-todo .panel-default {
		margin-bottom: 1px;
	}
</style>
<div class="row">
	<div class="col-md-3">
		<div id="todo-list-container" style="padding-left: 16px;">
			<?= $this->session->flashdata('msg') ?>
			<table class="table">
				<tbody>
					<?php if (count($list_access) > 0): ?>
					<?php foreach($list_access as $access): ?>
						<tr class="list">
							<td class="list-title" style="width: 95%"><?= $this->todo_lists_m->get_row(['LIST_ID' => $access->LIST_ID])->LIST_NAME ?>
								<input type="hidden" value="<?= $access->LIST_ID ?>">
							</td>
							<td><i class="material-icons">list</i></td>
						</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<h2>You don't have any list. Create one using the button below.</h2>
					<?php endif; ?>
				</tbody>
			</table>
			<button class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="width: 100%;">+ Create List</button>
		</div>
	</div>
	<div class="col-md-9">
		<div id="item-list">
			<?php 
				if (isset($first_list)):
			?>
			<div id="ongoing-todo">
				<?php  
					foreach ($first_list_item_ongoing as $item):
				?>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="item-checkbox">
								<span class="uncompleted-todo-item-title">Item 1</span>
							</label>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="separator"></div>
			<div class="btn btn-info" style="width: 100%;"id="show-todo-btn">
				Show completed todo
			</div>
			<div id="completed-todo" style="display: none;">
				<?php  
					foreach ($first_list_item_completed as $item):
				?>
				<div class="panel panel-default" style="opacity: 0.8;">
					<div class="panel-body">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="item-checkbox" checked>
								<span class="completed-todo-item-title">Item 1</span>
							</label>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- Modal Core -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create New List</h4>
      </div>
      <?= form_open('user') ?>
      <div class="modal-body">
      		<input type="text" name="list_name" class="form-control" placeholder="List name">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
      	<input type="submit" name="create_list" class="btn btn-info btn-simple" value="Save">
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="edit-list-modal" tabindex="-1" role="dialog" aria-labelledby="edit-list-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="edit-list-label">Edit List</h4>
      </div>
      <?= form_open('user') ?>
      <div class="modal-body">
      		<input type="text" name="list_name" id="edited_list_name" class="form-control" placeholder="List name">
      		<input type="hidden" name="list_id" id="edited_list_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
      	<input type="submit" name="edit_list" class="btn btn-info btn-simple" value="Save">
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="delete-confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Are you sure to delete <span id="delete-modal-list-title"></span>?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
        <button type="button" id="delete-btn" class="btn btn-info btn-simple">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Members -->
<div class="modal fade" id="list-member-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><span id="name-list-member">List</span> Members</h4>
      </div>
      <div class="modal-body">
      	<?= form_open('users') ?>
      		<div class="form-group">
      			<input type="email" name="email" class="form-control" placeholder="Email">
      			<input type="hidden" name="list_id" id="list-id-share">
      		</div>
      		<input type="submit" name="share" value="Invite" class="btn btn-info">
      	<?= form_close() ?>
      	<br>
      	<table class="table" id="list-member">
      		
      	</table>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<div id="rc-context-menu">
  <div class="menu-item" data-rc-launch="third">
  		<i class="material-icons">list</i>
      	<span class="context-label"><b id="context-list-title">Title</b></span>
      	<input type="hidden" id="context-list-id">
  </div>
  <div class="separator"></div>
  <div id="context-menu-edit" class="menu-item" data-toggle="modal" data-target="#edit-list-modal" class="menu-item" data-rc-launch="cut">
    	<i class="material-icons">mode_edit</i>
      	<span class="context-label">Edit</span>
  </div>
  <div id="context-menu-delete" data-toggle="modal" data-target="#delete-confirm-modal" class="menu-item" data-rc-launch="copy">
    	<i class="material-icons">delete</i>
      	<span class="context-label">Delete</span>
  </div>
  <div id="context-menu-member" data-toggle="modal" data-target="#list-member-modal" class="menu-item" data-rc-launch="copy">
    	<i class="material-icons">people</i>
      	<span class="context-label">List Members</span>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#context-menu-delete').on('click', function() {
			$('#delete-modal-list-title').text($('#context-list-title').text());
		});

		$('#context-menu-edit').on('click', function() {
			$('#edited_list_id').val($('#context-list-id').val());
		});

		$('#context-menu-member').on('click', function() {
			var listID = $('#context-list-id').val();
			$.get('<?= base_url('user?action=get_list_members&LIST_ID=') ?>' + listID, function(response) {
				var json = JSON.parse(response);
				$('#name-list-member').text(json.list_name);
				$('#list-id-share').val(listID);
				$('#list-member').html('');
				for (var i = 0; i < json.members.length; i++) {
					$('#list-member').append('<tr>' +
						'<td><i class="material-icons">account_circle</i> ' + json.members[i].email + '</td>' +
					'</tr>');
				}
			});
		});

		$('#delete-btn').on('click', function() {
			$.ajax({
				url: '<?= base_url('user') ?>',
				type: 'POST',
				data: {
					delete_list: true,
					list_id: $('#context-list-id').val()
				},
				success: function() {
					window.location = '<?= base_url('user') ?>'
				},
				error: function(e) {
					console.log(e.responseText);
				}
			});
		});

		$('#item-list').css('height', $(window).height() - 90);

		var shown = false;
		$('#show-todo-btn').on('click', function() {
			shown = !shown;
			if (shown) {
				$('#completed-todo').css('display', 'block');
			} else {
				$('#completed-todo').css('display', 'none');
			}
		});

		$('.list-title').on('click', function() {
			var childNode = $(this).children();
			console.log(childNode);
		    var listID = childNode[0].value;
			$.ajax({
				url: '<?= base_url('user') ?>',
				type: 'POST',
				data: {
					get_task: true,
					list_id: listID
				},
				success: function(response) {
					var json = JSON.parse(response);
					$('#ongoing-todo').html('');
					$('#completed-todo').html('');
					var ongoing_item = json.ongoing;
					console.log(ongoing_item);
					var completed_item = json.completed;
					for (var i = 0; i < ongoing_item.length; i++)
					{
						var panel = document.createElement('div');
						panel.className = 'panel panel-default';
						var panel_body = document.createElement('div');
						panel_body.className = 'panel-body';
						panel.appendChild(panel_body);
						var checkbox = document.createElement('div');
						checkbox.className = 'checkbox';
						panel_body.appendChild(checkbox);
						var label = document.createElement('label');
						checkbox.appendChild(label);
						var input = document.createElement('input');
						input.type = 'checkbox';
						input.name = 'item-checkbox';
						var span = document.createElement('span');
						span.className = 'uncompleted-todo-item-title';
						label.appendChild(input);
						label.appendChild(span);
						var textNode = document.createTextNode(ongoing_item[i].ITEM_DESC);
						span.appendChild(textNode);
						componentHandler.upgradeAllRegistered();
						$('#ongoing-todo').append(panel);
						// $('#ongoing-todo').append('<div class="panel panel-default">' +
						// 	'<div class="panel-body">' +
						// 		'<div class="checkbox">' +
						// 			'<label>' +
						// 				'<input type="checkbox" name="item-checkbox">' +
						// 				'<span class="uncompleted-todo-item-title">' + ongoing_item[i].ITEM_DESC + '</span>' +
						// 			'</label>' +
						// 		'</div>' +
						// 	'</div>' +
						// '</div>');
					}
				},
				error: function(e) {
					console.log(e.responseText);
				}
			});
		});
	});
</script>



<script type="text/javascript">
	$(document).ready(function() {
		/*
		legitRipple.js v1.0.0, Copyright by Matthias Vogt (ISC license)
		ripple.min.js, compiled: 12/10/2015 @ 0:29:21
		*/
		!function(t){t.fn.ripple=function(n,e){var i,o,a,s,r,p,l,u=20,c="ontouchstart"in window||"onmsgesturechange"in window,d=function(t,n){return(c?"touch"+t:"mouse"+n)+".ripple"},f=function(t){return c?t.originalEvent.touches.length:0},m=function(t){return c&&(t=t.originalEvent.touches[0]),[t.pageX,t.pageY]};if(this.off(".ripple").data("unbound",!0),n&&n.unbind)return this;this.addClass("legitRipple").removeData("unbound").on(d("start","down"),function(n){f(n)<=1&&(o=t(this),g(m(n)))}).on("dragstart.ripple",function(t){i.allowDragging||t.preventDefault()}),t(document).on(d("move","move"),function(t){o&&!o.data("unbound")&&f(t)<=1&&h(m(t))}).on(d("end","up"),function(t){!o||o.data("unbound")||f(t)||v()}).on("contextmenu.ripple",function(n){"WebkitAppearance"in document.documentElement.style&&t(document).trigger("mouseup.ripple")}),t(window).on("scroll.ripple blur.ripple",function(){o&&!o.data("unbound")&&v()});var g=function(n){i={},l=0,a=[o.outerWidth(),o.outerHeight()],w(),p=n,r=t("<span/>"),i.hasCustomRipple&&o.clone().children(".legitRipple-custom").last().removeClass("legitRipple-custom").appendTo(r),r.addClass("legitRipple-ripple").appendTo(o),x(n,!1),s=r.css("transition");var e=r.css("transition-duration").split(",");r.css("transition-duration",[5.5*parseFloat(e)+"s"].concat(e.slice(1)).join(",")).css("width",i.maxDiameter)},h=function(t){var n;if(l++,"proportional"==i.scaleMode){var e=Math.pow(l,l/100*5);n=e>40?40:e}else if("fixed"==i.scaleMode&&Math.abs(t[1]-p[1])>6)return void v();x(t,n)},v=function(){r.css("transition","all 0s linear 0s").css("width",r.css("width")).css("transition",s),setTimeout(function(){r.css("width",i.maxDiameter).css("opacity","0")},u),r.on("transitionend webkitTransitionEnd oTransitionEnd",function(){t(this).data("firstTransitionEnded")?t(this).off().remove():t(this).data("firstTransitionEnded",!0)}),o=null},w=function(){var e={dragging:!0,adaptPos:function(){return i.dragging},maxDiameter:function(){return Math.sqrt(Math.pow(a[0],2)+Math.pow(a[1],2))/o.outerWidth()*(i.adaptPos?100:200)+1+"%"},scaleMode:"fixed",hasCustomRipple:!1,allowDragging:!1};n=n||{},t.each(e,function(t,e){i[t]=n.hasOwnProperty(t)?n[t]:"function"==typeof e?e():e})},x=function(n,s){var p=[],u=[(n[0]-o.offset().left)/a[0],(n[1]-o.offset().top)/a[1]],c=[.5-u[0],.5-u[1]],d=[100/parseFloat(i.maxDiameter),100/parseFloat(i.maxDiameter)*(a[1]/a[0])],f=[c[0]*d[0],c[1]*d[1]],m=i.dragging||0===l;if(m&&"inline"==o.css("display")){var g=t("<span/>").text("Hi!").css("font-size",0).prependTo(o),h=g.offset().left;g.remove(),p=[n[0]-h+"px",n[1]-o.offset().top+"px"]}m&&(p=[p[0]||100*u[0]+"%",p[1]||100*u[1]+"%"],r.css("left",p[0]).css("top",p[1])),r.css("transform","translate3d(-50%, -50%, 0)"+(i.adaptPos?"translate3d("+100*f[0]+"%, "+100*f[1]+"%, 0)":"")+(s?"scale("+s+")":"")),e&&e(o,r,u,parseFloat(i.maxDiameter)/100)};return this},t.ripple=function(n){t.each(n,function(n,e){t(n).ripple(e[0]||e,e[1])})},t.ripple.destroy=function(){t(".legitRipple").removeClass("legitRipple").add(window).add(document).off(".ripple"),t(".legitRipple-ripple").remove(),$active=null}}(jQuery);

		$(".ripple").ripple();

		// Trigger action when the contexmenu is about to be shown

		$('#rc-context-menu').addClass('hidden');

		$('.list-title').bind("contextmenu", function (event) {
		    // Avoid the real one
		    event.preventDefault();
		    // Show contextmenu
		    $("#rc-context-menu").finish().toggleClass('hidden').
		    // In the right position (the mouse)
		    css({
		        top: event.pageY + "px",
		        left: event.pageX + "px"
		    });
		});

		// If the document is clicked somewhere
		$('.list-title').bind("mousedown", function (e) {
		    $('#context-list-title').text($(this).text());
		    $('#edited_list_name').val($(this).text());
		    var childNode = $(this).children();
		    var listID = childNode[0].value;
		    $('#context-list-id').val(listID);
		});

		$(document).bind("mousedown", function(e) {
			// If the clicked element is not the menu
		    if (!$(e.target).parents("#rc-context-menu").length > 0) {
		        // Hide it
		        $("#rc-context-menu").addClass('hidden');
		    }
		});

		// If the menu element is clicked
		$("#rc-context-menu div").click(function(){
		    // Hide it AFTER the action was triggered
		    $("#rc-context-menu").addClass('hidden');
		});
	});
</script>