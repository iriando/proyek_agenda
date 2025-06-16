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
                                <i class="bi bi-question-circle"></i><span> Link Slido Pertanyaan</span>
                            </a>
                        @endif
                    @endif

                    @if($agenda->materi->count() > 0)
                        @foreach($agenda->materi as $materi)
                            <a href="../uploads/{{$materi->file }}" download>
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
                </div>
            </div><!-- End Services List -->
