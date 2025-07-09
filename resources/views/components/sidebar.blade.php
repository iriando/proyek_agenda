            <div class="service-box">
                <h4>Daftar layanan</h4>
                <div class="services-list">
                    <a href="{{ route('agenda.show', $agenda->slug) }}" class="{{ request()->routeIs('agenda.show') ? 'active' : '' }}">
                        <i class="bi bi-ticket-detailed"></i><span> Detail Webinar</span>
                    </a>

                    @php
                        use Carbon\Carbon;
                        $now = Carbon::now();
                        $tanggalMulai = Carbon::parse($agenda->tanggal_pelaksanaan);
                        $isThirtyMinutesAfterStart = $now->greaterThanOrEqualTo($tanggalMulai->copy()->addMinutes(30));
                    @endphp

                    @if($agenda->status !== 'Selesai')
                        @if ($agenda->status === 'Sedang Berlangsung' && $isThirtyMinutesAfterStart)
                            <a href="{{ route('peserta.show', $agenda->slug) }}" class="{{ request()->routeIs('peserta.show') ? 'active' : '' }}">
                                <i class="bi bi-person-check"></i><span> Daftar Hadir</span>
                            </a>
                        @endif
                        @if(!empty($agenda->zoomlink))
                            <a href="{{ $agenda->zoomlink }}" target="_blank">
                                <i class="bi bi-camera-video"></i><span> Link Zoom Meeting</span>
                            </a>
                        @endif
                        @if(!empty($agenda->slidolink))
                            <a href="{{ route('slido.show', $agenda->slug) }}" class="{{ request()->routeIs('slido.show') ? 'active' : '' }}">
                                <i class="bi bi-question-circle"></i><span> Link Slido (Pertanyaan)</span>
                            </a>
                        @endif
                        @if(!empty($agenda->vb))
                            <a href="{{ asset('uploads/' . $agenda->vb) }}" target="_blank">
                                <i class="bi bi-card-image"></i><span> Download Virtual Background</span>
                            </a>
                        @endif
                    @endif

                    @if($agenda->materi->count() > 0)
                        @foreach($agenda->materi as $materi)
                            <a href="{{ asset('uploads/' . $materi->file) }}" download>
                                <i class="bi bi-file-earmark-arrow-down"></i><span>Download materi {{ $materi->judul }}</span>
                            </a>
                        @endforeach
                    @endif

                    @if($agenda->surveys->count() > 0)
                        @foreach ($agenda->surveys as $sv)
                            @if ($sv->is_active == 1)
                                <a href="{{ route('survey.show', ['agendaSlug' => $agenda->slug, 'surveySlug' => $sv->slug]) }}" class="{{ request()->routeIs('survey.show') && request()->route('surveySlug') === $sv->slug ? 'active' : '' }}">
                                    <i class="bi bi-clipboard-check"></i><span> {{ $sv->title }}</span>
                                </a>
                            @endif
                        @endforeach
                    @endif

                    @if(!empty($agenda->linksertifikat))
                        <a href="{{ $agenda->linksertifikat }}" target="_blank">
                            <i class="bi bi-paperclip"></i><span> Link Sertifikat</span>
                        </a>
                    @endif

                    @if($agenda->links->count() > 0)
                        @foreach($agenda->links as $link)
                            @if($link->is_active)
                                <a href="{{ $link->link }}" target="_blank"
                                    class="flex items-center space-x-1 py-1 px-2 text-sm {{ request()->url() === $link->link ? 'active' : '' }}">

                                    @if(Str::startsWith($link->icon, 'heroicon'))
                                        <i class="me-1 d-inline-flex align-items-center" style="width: 1.8rem; height: 1.8rem;">
                                            <x-dynamic-component :component="$link->icon" class="w-5 h-5" />
                                        </i>
                                    @else
                                        <i class="bi bi-link-45deg text-primary-600"></i>
                                    @endif

                                    <span>{{ $link->title }}</span>
                                </a>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div><!-- End Services List -->
