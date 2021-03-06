#
# src/test/Makefile.  Generated from Makefile.in by configure.
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
INSTALL = /usr/bin/install -c
LIBTOOL = ../../libtool

srcdir = ../../../src/test

have_libevent = 0
have_libuv = 0
have_libev = 0
NOLIBCHECK = nolibcheck

EXTENSION_LIBEVENT_EXT_LIBS=
EXTENSION_LIBEVENT_LDFLAGS=
EXTENSION_LIBUV_EXT_LIBS=
EXTENSION_LIBUV_LDFLAGS=
EXTENSION_LIBEV_EXT_LIBS=
EXTENSION_LIBEV_LDFLAGS=

CHECK_GETDNS=
CHECK_UV_PROG=
CHECK_EVENT_PROG=
CHECK_EV_PROG=

CC=gcc
CFLAGS=-I$(srcdir)/.. -I$(srcdir) -I.. $(cflags) -g -O2 -Wall -Wextra -D_BSD_SOURCE -D_DEFAULT_SOURCE  $(XTRA_CFLAGS)
WPEDANTICFLAG=-Wpedantic
LDFLAGS=-L.. 
LDLIBS=../libgetdns.la -lssl -lcrypto -lpthread 
CHECK_LIBS=
CHECK_CFLAGS=

CHECK_OBJS=check_getdns_common.lo check_getdns_context_set_timeout.lo \
	check_getdns.lo check_getdns_transport.lo

ALL_OBJS=$(CHECK_OBJS) check_getdns_libevent.lo check_getdns_libev.lo \
	check_getdns_selectloop.lo scratchpad.lo \
	testmessages.lo tests_dict.lo tests_list.lo tests_namespaces.lo \
	tests_stub_async.lo tests_stub_sync.lo

NON_C99_OBJS=check_getdns_libuv.lo

PROGRAMS=tests_dict tests_list tests_namespaces tests_stub_async tests_stub_sync $(CHECK_GETDNS) $(CHECK_EV_PROG) $(CHECK_EVENT_PROG) $(CHECK_UV_PROG)


.SUFFIXES: .c .o .a .lo .h

.c.o:
	$(CC) $(CFLAGS) $(WPEDANTICFLAG) -c $< -o $@

.c.lo:
	$(LIBTOOL) --quiet --tag=CC --mode=compile $(CC) $(CFLAGS) $(WPEDANTICFLAG) -c $< -o $@

default: all

all: $(PROGRAMS)

$(ALL_OBJS):
	$(LIBTOOL) --quiet --tag=CC --mode=compile $(CC) $(CFLAGS) $(WPEDANTICFLAG) -c $(srcdir)/$(@:.lo=.c) -o $@

$(NON_C99_OBJS):
	$(LIBTOOL) --quiet --tag=CC --mode=compile $(CC) $(CFLAGS) $(WPEDANTICFLAG) -D_POSIX_C_SOURCE=200112L -D_XOPEN_SOURCE=600 -c $(srcdir)/$(@:.lo=.c) -o $@

tests_dict: tests_dict.lo testmessages.lo
	$(LIBTOOL) --tag=CC --mode=link $(CC) $(LDFLAGS) $(LDLIBS) -o $@ tests_dict.lo testmessages.lo

tests_list: tests_list.lo testmessages.lo
	$(LIBTOOL) --tag=CC --mode=link $(CC) $(LDFLAGS) $(LDLIBS) -o $@ tests_list.lo testmessages.lo

tests_namespaces: tests_namespaces.lo 
	$(LIBTOOL) --tag=CC --mode=link $(CC) $(LDFLAGS) $(LDLIBS) -o $@ tests_namespaces.lo 

tests_stub_async: tests_stub_async.lo testmessages.lo
	$(LIBTOOL) --tag=CC --mode=link $(CC) $(LDFLAGS) $(LDLIBS) -o $@ tests_stub_async.lo testmessages.lo

tests_stub_sync: tests_stub_sync.lo
	$(LIBTOOL) --tag=CC --mode=link $(CC) $(LDFLAGS) $(LDLIBS) -o $@ tests_stub_sync.lo

check_getdns_common: check_getdns_common.lo
	$(LIBTOOL) --tag=CC --mode=link $(CC) $(LDFLAGS) $(LDLIBS) -o $@ check_getdns_common.lo

check_getdns: check_getdns.lo check_getdns_common.lo check_getdns_context_set_timeout.lo check_getdns_transport.lo check_getdns_selectloop.lo
	$(LIBTOOL) --tag=CC --mode=link $(CC) $(LDFLAGS) $(LDLIBS) $(CHECK_LIBS) -o $@ check_getdns.lo check_getdns_common.lo  check_getdns_context_set_timeout.lo check_getdns_transport.lo check_getdns_selectloop.lo

check_getdns_event: check_getdns.lo check_getdns_common.lo check_getdns_context_set_timeout.lo check_getdns_transport.lo check_getdns_libevent.lo ../libgetdns_ext_event.la
	$(LIBTOOL) --tag=CC --mode=link $(CC) -o $@ check_getdns.lo check_getdns_common.lo check_getdns_context_set_timeout.lo check_getdns_transport.lo check_getdns_libevent.lo $(LDFLAGS) $(LDLIBS) $(CHECK_LIBS) ../libgetdns_ext_event.la $(EXTENSION_LIBEVENT_LDFLAGS) $(EXTENSION_LIBEVENT_EXT_LIBS)

check_getdns_uv: check_getdns.lo check_getdns_common.lo check_getdns_context_set_timeout.lo check_getdns_transport.lo check_getdns_libuv.lo ../libgetdns_ext_uv.la
	$(LIBTOOL) --tag=CC --mode=link $(CC) -o $@ check_getdns.lo check_getdns_common.lo check_getdns_context_set_timeout.lo check_getdns_transport.lo check_getdns_libuv.lo $(LDFLAGS) $(LDLIBS) $(CHECK_LIBS) ../libgetdns_ext_uv.la $(EXTENSION_LIBUV_LDFLAGS) $(EXTENSION_LIBUV_EXT_LIBS)

check_getdns_ev: check_getdns.lo check_getdns_common.lo check_getdns_context_set_timeout.lo check_getdns_transport.lo check_getdns_libev.lo ../libgetdns_ext_ev.la
	$(LIBTOOL) --tag=CC --mode=link $(CC) -o $@ check_getdns.lo check_getdns_common.lo check_getdns_context_set_timeout.lo check_getdns_transport.lo check_getdns_libev.lo $(LDFLAGS) $(LDLIBS) $(CHECK_LIBS) ../libgetdns_ext_ev.la $(EXTENSION_LIBEV_LDFLAGS) $(EXTENSION_LIBEV_EXT_LIBS)

scratchpad: scratchpad.lo
	$(LIBTOOL) --tag=CC --mode=link $(CC) -o $@ scratchpad.lo $(LDFLAGS) $(LDLIBS)

scratchpad.lo: scratchpad.c

$(srcdir)/scratchpad.c: scratchpad.template.c
	[ ! -f $(srcdir)/scratchpad.c ] && cp -p $(srcdir)/scratchpad.template.c $(srcdir)/scratchpad.c || true

install:
	echo nothing to install

uninstall:
	echo nothing to uninstall

nolibcheck:
	@echo "***"
	@echo "*** Cannot run unit tests, because they could not be compiled,"
	@echo "*** because libcheck was not found or usable at configure time."
	@echo "*** To compile and run unit tests make sure libcheck is available"
	@echo "*** and usable during configuration"
	@echo "***"
	@false

test_noeventloop: $(NOLIBCHECK) all
	rm -f $(CHECK_GETDNS).failed
	GETDNS_TEST_PORT=43210 CK_TIMEOUT_MULTIPLIER=2 CK_LOG_FILE_NAME="$(CHECK_GETDNS).log" ./$(CHECK_GETDNS) || echo "$(CHECK_GETDNS) failed" >> $(CHECK_GETDNS).failed

test_libevent: $(NOLIBCHECK) all
	rm -f $(CHECK_EVENT_PROG).failed
	if test $(have_libevent) = 1 ; then GETDNS_TEST_PORT=44321 CK_TIMEOUT_MULTIPLIER=2 CK_LOG_FILE_NAME="$(CHECK_EVENT_PROG).log" ./$(CHECK_EVENT_PROG) || echo "$(CHECK_EVENT_PROG) failed" >> $(CHECK_EVENT_PROG).failed; fi

test_libev: $(NOLIBCHECK) all
	rm -f $(CHECK_EV_PROG).failed
	if test $(have_libev) = 1 ; then GETDNS_TEST_PORT=45432 CK_TIMEOUT_MULTIPLIER=2 CK_LOG_FILE_NAME="$(CHECK_EV_PROG).log" ./$(CHECK_EV_PROG) || echo "$(CHECK_EV_PROG) failed" >> $(CHECK_EV_PROG).failed; fi

test_libuv: $(NOLIBCHECK) all
	rm -f $(CHECK_UV_PROG).failed
	if test $(have_libev) = 1 ; then GETDNS_TEST_PORT=46543 CK_TIMEOUT_MULTIPLIER=2 CK_LOG_FILE_NAME="$(CHECK_UV_PROG).log" ./$(CHECK_UV_PROG) || echo "$(CHECK_UV_PROG) failed" >> $(CHECK_UV_PROG).failed; fi

test: test_noeventloop test_libevent test_libev test_libuv
	rm -f fails
	if test -f $(CHECK_GETDNS).failed     ; then cat $(CHECK_GETDNS).failed     >> fails ; fi
	if test -f $(CHECK_EVENT_PROG).failed ; then cat $(CHECK_EVENT_PROG).failed >> fails ; fi
	if test -f $(CHECK_EV_PROG).failed    ; then cat $(CHECK_EV_PROG).failed    >> fails ; fi
	if test -f $(CHECK_UV_PROG).failed    ; then cat $(CHECK_UV_PROG).failed    >> fails ; fi
	test ! -e fails
	@echo "All tests OK"

clean:
	rm -f *.o *.lo $(PROGRAMS) scratchpad
	rm -rf .libs
	rm -f check_getdns.log check_getdns_event.log check_getdns_ev.log check_getdns_uv.log

distclean : clean
	rm -f scratchpad.c
	rm -f Makefile config.status config.log
	rm -f check_getdns_uv.core check_getdns.core check_getdns_event.core
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
	cd ../.. && ./config.status src/test/Makefile

configure.status: configure
	cd ../.. && ./config.status --recheck

depend:
	(cd $(srcdir) ; awk 'BEGIN{P=1}{if(P)print}/^# Dependencies/{P=0}' Makefile.in > Makefile.in.new )
	(blddir=`pwd`; cd $(srcdir) ; gcc -MM -I. -I.. -I"$$blddir"/.. *.c | \
		sed -e "s? $$blddir/? ?g" \
		    -e 's? \([a-z0-9_-]*\)\.\([ch]\)? $$(srcdir)/\1.\2?g' \
		    -e 's? \.\./\([a-z0-9_-]*\)\.h? $$(srcdir)/../\1.h?g' \
		    -e 's? \.\./\([a-z0-9_-]*\)/\([a-z0-9_-]*\)\.h? $$(srcdir)/../\1/\2.h?g' \
		    -e 's? \$$(srcdir)/config\.h? ../config.h?g' \
		    -e 's? \$$(srcdir)/\.\./config\.h? ../config.h?g' \
		    -e 's? \$$(srcdir)/\.\./getdns/getdns\.h? ../getdns/getdns.h?g' \
		    -e 's? \$$(srcdir)/\.\./getdns/getdns_extra\.h? ../getdns/getdns_extra.h?g' \
		    -e 's!\(.*\)\.o[ :]*!\1.lo \1.o: !g' >> Makefile.in.new )
	(cd $(srcdir) ; diff Makefile.in.new Makefile.in && rm Makefile.in.new \
	                                                 || mv Makefile.in.new Makefile.in )

.PHONY: clean test

# Dependencies for the unit tests
check_getdns.lo check_getdns.o: $(srcdir)/check_getdns.c \
 ../getdns/getdns.h \
 $(srcdir)/check_getdns_common.h \
 ../getdns/getdns_extra.h \
 $(srcdir)/check_getdns_address.h $(srcdir)/check_getdns_address_sync.h \
 $(srcdir)/check_getdns_cancel_callback.h $(srcdir)/check_getdns_context_create.h \
 $(srcdir)/check_getdns_context_destroy.h \
 $(srcdir)/check_getdns_context_set_context_update_callback.h \
 $(srcdir)/check_getdns_context_set_dns_transport.h \
 $(srcdir)/check_getdns_context_set_timeout.h \
 $(srcdir)/check_getdns_context_set_upstream_recursive_servers.h \
 $(srcdir)/check_getdns_convert_alabel_to_ulabel.h \
 $(srcdir)/check_getdns_convert_ulabel_to_alabel.h $(srcdir)/check_getdns_dict_destroy.h \
 $(srcdir)/check_getdns_dict_get_bindata.h $(srcdir)/check_getdns_dict_get_data_type.h \
 $(srcdir)/check_getdns_dict_get_dict.h $(srcdir)/check_getdns_dict_get_int.h \
 $(srcdir)/check_getdns_dict_get_list.h $(srcdir)/check_getdns_dict_get_names.h \
 $(srcdir)/check_getdns_dict_set_bindata.h $(srcdir)/check_getdns_dict_set_dict.h \
 $(srcdir)/check_getdns_dict_set_int.h $(srcdir)/check_getdns_dict_set_list.h \
 $(srcdir)/check_getdns_display_ip_address.h $(srcdir)/check_getdns_general.h \
 $(srcdir)/check_getdns_general_sync.h $(srcdir)/check_getdns_hostname.h \
 $(srcdir)/check_getdns_hostname_sync.h $(srcdir)/check_getdns_list_get_bindata.h \
 $(srcdir)/check_getdns_list_get_data_type.h $(srcdir)/check_getdns_list_get_dict.h \
 $(srcdir)/check_getdns_list_get_int.h $(srcdir)/check_getdns_list_get_length.h \
 $(srcdir)/check_getdns_list_get_list.h $(srcdir)/check_getdns_pretty_print_dict.h \
 $(srcdir)/check_getdns_service.h $(srcdir)/check_getdns_service_sync.h \
 $(srcdir)/check_getdns_transport.h
check_getdns_common.lo check_getdns_common.o: $(srcdir)/check_getdns_common.c \
 ../getdns/getdns.h \
 ../config.h \
 $(srcdir)/check_getdns_common.h \
 ../getdns/getdns_extra.h \
 $(srcdir)/check_getdns_eventloop.h
check_getdns_context_set_timeout.lo check_getdns_context_set_timeout.o: $(srcdir)/check_getdns_context_set_timeout.c \
 $(srcdir)/check_getdns_context_set_timeout.h $(srcdir)/check_getdns_common.h \
 ../getdns/getdns.h \
 ../getdns/getdns_extra.h
check_getdns_libev.lo check_getdns_libev.o: $(srcdir)/check_getdns_libev.c $(srcdir)/check_getdns_eventloop.h \
 ../config.h \
 ../getdns/getdns.h \
 $(srcdir)/../getdns/getdns_ext_libev.h \
 ../getdns/getdns_extra.h \
 $(srcdir)/check_getdns_common.h
check_getdns_libevent.lo check_getdns_libevent.o: $(srcdir)/check_getdns_libevent.c $(srcdir)/check_getdns_eventloop.h \
 ../config.h \
 ../getdns/getdns.h \
 $(srcdir)/../getdns/getdns_ext_libevent.h \
 ../getdns/getdns_extra.h \
 $(srcdir)/check_getdns_libevent.h $(srcdir)/check_getdns_common.h
check_getdns_libuv.lo check_getdns_libuv.o: $(srcdir)/check_getdns_libuv.c $(srcdir)/check_getdns_eventloop.h \
 ../config.h \
 ../getdns/getdns.h \
 $(srcdir)/../getdns/getdns_ext_libuv.h \
 ../getdns/getdns_extra.h \
 $(srcdir)/check_getdns_common.h
check_getdns_selectloop.lo check_getdns_selectloop.o: $(srcdir)/check_getdns_selectloop.c \
 $(srcdir)/check_getdns_eventloop.h \
 ../config.h \
 ../getdns/getdns.h \
 ../getdns/getdns_extra.h
check_getdns_transport.lo check_getdns_transport.o: $(srcdir)/check_getdns_transport.c \
 $(srcdir)/check_getdns_transport.h $(srcdir)/check_getdns_common.h \
 ../getdns/getdns.h \
 ../getdns/getdns_extra.h
scratchpad.template.lo scratchpad.template.o: scratchpad.template.c \
 ../getdns/getdns.h \
 ../getdns/getdns_extra.h
testmessages.lo testmessages.o: $(srcdir)/testmessages.c $(srcdir)/testmessages.h
tests_dict.lo tests_dict.o: $(srcdir)/tests_dict.c $(srcdir)/testmessages.h \
 ../getdns/getdns.h
tests_list.lo tests_list.o: $(srcdir)/tests_list.c $(srcdir)/testmessages.h \
 ../getdns/getdns.h
tests_namespaces.lo tests_namespaces.o: $(srcdir)/tests_namespaces.c $(srcdir)/testmessages.h \
 ../getdns/getdns.h
tests_stub_async.lo tests_stub_async.o: $(srcdir)/tests_stub_async.c \
 ../config.h \
 $(srcdir)/testmessages.h \
 ../getdns/getdns.h \
 ../getdns/getdns_extra.h
tests_stub_sync.lo tests_stub_sync.o: $(srcdir)/tests_stub_sync.c $(srcdir)/testmessages.h \
 ../getdns/getdns.h \
 ../getdns/getdns_extra.h
