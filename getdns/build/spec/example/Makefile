#
# spec/example/Makefile.  Generated from Makefile.in by configure.
#
# Copyright (c) 2013, Verisign, Inc., NLNet Labs
# All rights reserved.
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions are met:
# * Redistributions of source code must retain the above copyright
# notice, this list of conditions and the following disclaimer.
# * Redistributions in binary form must reproduce the above copyright
#   notice, this list of conditions and the following disclaimer in the
#   documentation and/or other materials provided with the distribution.
# * Neither the names of the copyright holders nor the
#   names of its contributors may be used to endorse or promote products
#   derived from this software without specific prior written permission.
#
# THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
# ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
# WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
# DISCLAIMED. IN NO EVENT SHALL Verisign, Inc. BE LIABLE FOR ANY
# DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
# (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
# LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
# ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
# (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
# SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

package = getdns
version = 1.4.2
tarname = getdns
distdir = $(tarname)-$(version)

prefix = /usr/local
exec_prefix = ${prefix}
bindir = ${exec_prefix}/bin
LIBTOOL = ../../libtool

srcdir = ../../../spec/example

EXTENSION_LIBEVENT_EXT_LIBS=
EXTENSION_LIBEVENT_LDFLAGS=
EXTENSION_LIBEVENT_LIB=../../src/libgetdns_ext_event.la

CC=gcc
CFLAGS=-I$(srcdir) -I$(srcdir)/../../src -I../../src -g -O2 -Wall -Wextra -D_BSD_SOURCE -D_DEFAULT_SOURCE
LDFLAGS= -L../../src
LDLIBS=../../src/libgetdns.la -lssl -lcrypto -lpthread 


OBJS=example-all-functions.lo example-simple-answers.lo example-tree.lo example-synchronous.lo example-reverse.lo

PROGRAMS=example-all-functions example-synchronous example-simple-answers example-tree example-reverse

.SUFFIXES: .c .o .a .lo .h

.c.o:
	$(CC) $(CFLAGS) -c $< -o $@

.c.lo:
	$(LIBTOOL) --quiet --tag=CC --mode=compile $(CC) $(CFLAGS) -c $< -o $@

default: all
example: all

all: $(PROGRAMS)

$(OBJS):
	$(LIBTOOL) --quiet --tag=CC --mode=compile $(CC) $(CFLAGS) -c $(srcdir)/$(@:.lo=.c) -o $@

example-all-functions: example-all-functions.lo
	 $(LIBTOOL) --tag=CC --mode=link $(CC) $(CFLAGS) $(LDFLAGS) $(LDLIBS) -o $@ example-all-functions.lo

example-synchronous: example-synchronous.lo
	 $(LIBTOOL) --tag=CC --mode=link $(CC) $(CFLAGS) $(LDFLAGS) $(LDLIBS) -o $@ example-synchronous.lo

$(EXTENSION_LIBEVENT_LIB):
	@echo "***"
	@echo "*** Three examples from the specification need libevent."
	@echo "*** libevent was not found or usable at configure time."
	@echo "*** To compile and run all examples from the spec, make sure"
	@echo "*** libevent is available and usable during configuration."
	@echo "***"
	@false

example-simple-answers:	example-simple-answers.lo $(EXTENSION_LIBEVENT_LIB)
	 $(LIBTOOL) --tag=CC --mode=link $(CC) $(CFLAGS) $(LDFLAGS) $(EXTENSION_LIBEVENT_LIB) $(EXTENSION_LIBEVENT_LDFLAGS) $(EXTENSION_LIBEVENT_EXT_LIBS) $(LDLIBS) -o $@ example-simple-answers.lo

example-tree: example-tree.lo $(EXTENSION_LIBEVENT_LIB)
	 $(LIBTOOL) --tag=CC --mode=link $(CC) $(CFLAGS) $(LDFLAGS) $(EXTENSION_LIBEVENT_LIB) $(EXTENSION_LIBEVENT_LDFLAGS) $(EXTENSION_LIBEVENT_EXT_LIBS) $(LDLIBS) -o $@ example-tree.lo

example-reverse: example-reverse.lo $(EXTENSION_LIBEVENT_LIB)
	 $(LIBTOOL) --tag=CC --mode=link $(CC) $(CFLAGS) $(LDFLAGS) $(EXTENSION_LIBEVENT_LIB) $(EXTENSION_LIBEVENT_LDFLAGS) $(EXTENSION_LIBEVENT_EXT_LIBS) $(LDLIBS) -o $@ example-reverse.lo

clean:
	rm -f *.o *.lo $(PROGRAMS)
	rm -rf .libs

distclean : clean
	rm -f Makefile config.status config.log
	rm -Rf autom4te.cache

$(distdir): FORCE
	mkdir -p $(distdir)/src
	cp configure.ac $(distdir)
	cp configure $(distdir)
	cp Makefile.in $(distdir)
	cp src/Makefile.in $(distdir)/src

distcheck: $(distdir).tar.gz
	gzip -cd $(distdir).tar.gz | tar xvf -
	cd $(distdir) && ./configure
	cd $(distdir) && $(MAKE) all
	cd $(distdir) && $(MAKE) check
	cd $(distdir) && $(MAKE) DESTDIR=$${PWD}/_inst install
	cd $(distdir) && $(MAKE) DESTDIR=$${PWD}/_inst uninstall
	@remaining="`find $${PWD}/$(distdir)/_inst -type f | wc -l`"; \
	if test "$${remaining}" -ne 0; then
	  echo "@@@ $${remaining} file(s) remaining in stage directory!"; \
	  exit 1; \
	fi
	cd $(distdir) && $(MAKE) clean
	rm -rf $(distdir)
	@echo "*** Package $(distdir).tar.gz is ready for distribution"

Makefile: $(srcdir)/Makefile.in ../../config.status
	cd ../.. && ./config.status spec/example/Makefile

configure.status: configure
	cd ../.. && ./config.status --recheck

.PHONY: clean

depend:
	(cd $(srcdir) ; awk 'BEGIN{P=1}{if(P)print}/^# Dependencies/{P=0}' Makefile.in > Makefile.in.new )
	(blddir=`pwd`; cd $(srcdir) ; gcc -MM -I. -I../../src -I"$$blddir"/../../src *.c | \
		sed -e "s? $$blddir/? ?g" \
		    -e 's? \([a-z_-]*\)\.\([ch]\)? $$(srcdir)/\1.\2?g' \
		    -e 's? \$$(srcdir)/\.\./\.\./src/config\.h? ../../src/config.h?g' \
		    -e 's? $$(srcdir)/\.\./\.\./src/getdns/getdns_extra\.h? ../../src/getdns/getdns_extra.h?g' \
		    -e 's? \.\./\.\./src/getdns/getdns_ext_libevent\.h? $$(srcdir)/../../src/getdns/getdns_ext_libevent.h?g' \
		    -e 's? \.\./\.\./src/getdns/getdns_ext_libev\.h? $$(srcdir)/../../src/getdns/getdns_ext_libev.h?g' \
		    -e 's? \.\./\.\./src/getdns/getdns_ext_libuv\.h? $$(srcdir)/../../src/getdns/getdns_ext_libuv.h?g' \
		    -e 's? \.\./\.\./src/debug\.h? $$(srcdir)/../../src/debug.h?g' \
		    -e 's!\(.*\)\.o[ :]*!\1.lo \1.o: !g' >> Makefile.in.new )
	(cd $(srcdir) ; diff Makefile.in.new Makefile.in && rm Makefile.in.new \
	                                                 || mv Makefile.in.new Makefile.in )


# Dependencies for the examples
example-all-functions.lo example-all-functions.o: $(srcdir)/example-all-functions.c $(srcdir)/getdns_libevent.h \
 ../../src/config.h \
 ../../src/getdns/getdns.h \
 $(srcdir)/../../src/getdns/getdns_ext_libevent.h \
 ../../src/getdns/getdns_extra.h
example-reverse.lo example-reverse.o: $(srcdir)/example-reverse.c $(srcdir)/getdns_libevent.h \
 ../../src/config.h \
 ../../src/getdns/getdns.h \
 $(srcdir)/../../src/getdns/getdns_ext_libevent.h \
 ../../src/getdns/getdns_extra.h
example-simple-answers.lo example-simple-answers.o: $(srcdir)/example-simple-answers.c $(srcdir)/getdns_libevent.h \
 ../../src/config.h \
 ../../src/getdns/getdns.h \
 $(srcdir)/../../src/getdns/getdns_ext_libevent.h \
 ../../src/getdns/getdns_extra.h
example-synchronous.lo example-synchronous.o: $(srcdir)/example-synchronous.c $(srcdir)/getdns_core_only.h \
 ../../src/getdns/getdns.h
example-tree.lo example-tree.o: $(srcdir)/example-tree.c $(srcdir)/getdns_libevent.h \
 ../../src/config.h \
 ../../src/getdns/getdns.h \
 $(srcdir)/../../src/getdns/getdns_ext_libevent.h \
 ../../src/getdns/getdns_extra.h
