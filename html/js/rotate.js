Rotate = Class.create({
  initialize: function( element, options ) {
    this.element = $(element);
    this.options = options;

    this.options.transition = this.options.transition || 1;
    this.options.pause = this.options.pause || 4;
    this.delay = this.options.transition + this.options.pause;

    if( this.options.select_class )
      this.options.first = this.element.down('.'+this.options.select_class);

    this.current_child = this.options.first || this.element.down();
    this.set_next_child();

    this.transition = null;
    this.timer = new PeriodicalExecuter( this.transition_to.bind( this ), this.delay );
  },
  set_next_child: function() {
    this.next_child = this.current_child.next() || this.element.down();
    if( this.current_child == this.next_child ) {
      this.next_child = null;
    }
  },
  transition_to: function( pe ) {
    this.finish_current_transition();

    if( !this.next_child )
      return;

    this.transition = new PeriodicalExecuter( this.pause_step.bind( this ), this.options.pause );
  },
  pause_step: function( pe ) {
    pe.stop();
    this.transition = new PeriodicalExecuter( this.transition_step.bind( this ), 1.0/30 );
  },
  start_current_transition: function() {
    this.transition.step = 0.0;
    this.transition.total = 100;
    /* since this is a holey inaccurate way to do timing, we will accelerate our timings
       by ten percent, incase the computer is a bit slow */
    this.transition.delta = 1.0 * 100 / this.options.transition / 30 * 1.1;
    
    if( this.options.select_class ) {
      this.current_child.addClassName( this.options.select_class );
      this.next_child.addClassName( this.options.select_class );
    }
    this.current_child.setStyle({ opacity: 1.0 });
    this.next_child.setStyle({ opacity: 0.0 });
  },
  finish_current_transition: function() {
    if( !this.transition )
      return;
    this.transition.stop();

    if( !this.transition.step )
      return;

    if( this.options.select_class )
      this.current_child.removeClassName( this.options.select_class );
    this.next_child.setStyle({ opacity: 1.0 });
    this.current_child.setStyle({ opacity: 1.0 });
    
    this.transition = null;
    this.advance_transition();
  },
  advance_transition: function() {
    this.current_child = this.next_child;
    this.set_next_child();
  },
  transition_step: function( pe ) {
    if( !this.transition.step )
      this.start_current_transition();

    this.current_child.setStyle({ opacity: 1 - .999*this.transition.step / this.transition.total });
    this.next_child.setStyle({ opacity: .999*this.transition.step / this.transition.total });

    this.transition.step += this.transition.delta;
    if( this.transition.step >= this.transition.total )
      this.finish_current_transition();
  }
});
