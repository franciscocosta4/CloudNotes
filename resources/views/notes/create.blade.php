<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partilhar Anotação</title>
    <!-- Preload do Google Fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" as="style"
        onload="this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    </noscript>
    <style>
        :root {
            --primary-color: #0F044C;
            --secondary-color: #F8F9FA;
            --text-color: #444;
            --border-color: #ddd;
            --error-color: #dc3545;
            --hover-effect: scale(1.02);
        }

        body,
        html {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Estilos específicos para a página de partilha */
        .container {
            width: 100%;
            max-width: 1100px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        .container h2 {
            font-size: 1.7rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .container p {
            margin-bottom: 1.5rem;
            color: var(--text-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group.inline {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .form-group.inline > div {
            flex: 1;
            min-width: 200px;
        }

        .form-label {
            font-size: 0.95rem;
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-color);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 8px rgba(15, 4, 76, 0.1);
            outline: none;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
        }

        /* Estilo específico para o input de arquivo */
        .file-input-container {
            position: relative;
            margin-top: 0.5rem;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background-color: #f8f9fa;
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-label:hover {
            border-color: var(--primary-color);
            background-color: rgba(15, 4, 76, 0.05);
        }

        .file-input-label span {
            color: var(--text-color);
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-input-label .browse-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            font-size: 0.85rem;
            margin-left: 1rem;
            flex-shrink: 0;
        }

        .file-input {
            position: absolute;
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            z-index: -1;
        }

        .file-hint {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.5rem;
            display: block;
        }

        #content {
            border: 2px solid var(--border-color);
            min-height: 300px;
        }

        .text-danger {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: block;
        }

        .btn {
            font-family: 'Poppins', sans-serif;
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: var(--hover-effect);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        #back-button {
            background-color: #6c757d;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
                margin: 1rem auto;
            }
            
            .form-group.inline {
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Partilhar Anotação</h2>
        <p>
            Insira os dados do seu resumo:
        </p>
        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group inline">
                <div>
                    <label for="subject" class="form-label">Disciplina</label>
                    <select name="subject" id="subject" class="form-control" required>
                        @foreach(\App\Models\Subject::all() as $subject)
                            <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="topic_difficulty" class="form-label">Dificuldade</label>
                    <select name="topic_difficulty" id="topic_difficulty" class="form-control" required>
                        <option value="Fácil">Fácil</option>
                        <option value="Moderada">Moderada</option>
                        <option value="Difícil">Difícil</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="form-label">Conteúdo</label>
                <p>
                    Escreva aqui o conteúdo do seu resumo:
                </p>
                <textarea name="content" id="content" class="form-control" rows="30"
                    style="resize: vertical; overflow-y: auto;"></textarea>
                <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#content'), {
                            extraPlugins: [MyCustomUploadAdapterPlugin],
                        })
                        .catch(error => {
                            console.error(error);
                        });

                    function MyCustomUploadAdapterPlugin(editor) {
                        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                            return new MyUploadAdapter(loader);
                        };
                    }

                    class MyUploadAdapter {
                        constructor(loader) {
                            this.loader = loader;
                        }
                        upload() {
                            return this.loader.file.then(file => {
                                return new Promise((resolve, reject) => {
                                    const data = new FormData();
                                    data.append('upload', file);

                                    fetch('{{ route('upload.image') }}', {
                                        method: 'POST',
                                        body: data,
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            resolve({
                                                default: data.url
                                            });
                                        })
                                        .catch(err => {
                                            reject(err);
                                        });
                                });
                            });
                        }
                    }
                </script>
            </div>
            <div class="form-group">
                <label for="file_path" class="form-label">Arquivo (opcional)</label>
                <div class="file-input-container">
                    <label for="file_path" class="file-input-label">
                        <span id="file-name">Nenhum arquivo selecionado</span>
                        <span class="browse-btn">Procurar</span>
                    </label>
                    <input type="file" name="file_path" id="file_path" class="file-input" accept=".pdf">
                    <small class="file-hint">Formatos aceites: .pdf (tamanho máximo: 10MB)</small>
                </div>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn">Partilhar</button>
                <button type="button" id="back-button" class="btn" onclick="window.history.back()">Voltar</button>
            </div>
        </form>
    </div>

    <script>
        // Mostrar nome do arquivo selecionado
        document.getElementById("file_path").addEventListener("change", function() {
            const fileName = this.files[0] ? this.files[0].name : "Nenhum arquivo selecionado";
            document.getElementById("file-name").textContent = fileName;
            
            // Validação do tipo de arquivo
            if (this.files[0]) {
                const allowedExtensions = ["pdf"];
                const fileExtension = this.files[0].name.split(".").pop().toLowerCase();
                if (!allowedExtensions.includes(fileExtension)) {
                    alert("Apenas ficheiros .pdf são permitidos.");
                    this.value = "";
                    document.getElementById("file-name").textContent = "Nenhum arquivo selecionado";
                }
            }
        });

        // Validação do formulário
        document.querySelector('form').addEventListener('submit', function(event) {
            const content = document.getElementById('content').value.trim();
            const file = document.getElementById('file_path').files.length > 0;

            if (!content && !file) {
                event.preventDefault();
                alert('Você deve fornecer um conteúdo ou um arquivo.');
            }
        });
    </script>
</body>
</html>