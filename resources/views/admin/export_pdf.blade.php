<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Relatório de Locais - Admin</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            font-size: 11px; 
            line-height: 1.3;
            color: #333;
            margin: 0;
            padding: 15px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #2D3748;
        }
        
        .header h1 {
            color: #2D3748;
            margin: 0 0 5px 0;
            font-size: 18px;
        }
        
        .header .subtitle {
            color: #4A5568;
            font-size: 12px;
            margin: 0;
        }
        
        .info-box {
            background: #F7FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .info-label {
            font-weight: 600;
            color: #4A5568;
        }
        
        .info-value {
            color: #2D3748;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px;
            font-size: 10px;
        }
        
        th { 
            background: #2D3748; 
            color: white;
            font-weight: 600;
            padding: 8px 6px;
            border: 1px solid #4A5568;
            text-align: left;
        }
        
        td { 
            padding: 6px;
            border: 1px solid #E2E8F0;
            vertical-align: top;
        }
        
        tr:nth-child(even) {
            background: #F7FAFC;
        }
        
        .status-active {
            color: #38A169;
            font-weight: 600;
        }
        
        .status-inactive {
            color: #E53E3E;
            font-weight: 600;
        }
        
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #E2E8F0;
            text-align: center;
            color: #718096;
            font-size: 9px;
        }
        
        /* Quebra de página para impressão */
        @media print {
            body { margin: 0; }
            .header { margin-top: 0; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Locais Cadastrados</h1>
        <p class="subtitle">Sistema de Gerenciamento - {{ now()->format('d/m/Y H:i') }}</p>
    </div>
    
    <div class="info-box">
        <div class="info-row">
            <span class="info-label">Total de Locais:</span>
            <span class="info-value">{{ $locals->count() }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Locais Ativos:</span>
            <span class="info-value">{{ $locals->where('is_active', true)->count() }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Locais Inativos:</span>
            <span class="info-value">{{ $locals->where('is_active', false)->count() }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="40">ID</th>
                <th width="120">Título</th>
                <th width="80">Categoria</th>
                <th width="150">Descrição</th>
                <th width="120">Endereço</th>
                <th width="80">Cidade</th>
                <th width="50">Estado</th>
                <th width="60">CEP</th>
                <th width="40">Ativo</th>
                <th width="80">Criado em</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locals as $local)
            <tr>
                <td>{{ $local->id }}</td>
                <td><strong>{{ $local->title }}</strong></td>
                <td>{{ $local->category }}</td>
                <td>{{ Str::limit($local->description, 50) }}</td>
                <td>{{ $local->address }} {{ $local->address_number }}</td>
                <td>{{ $local->city }}</td>
                <td>{{ $local->state }}</td>
                <td>{{ $local->cep }}</td>
                <td>
                    @if($local->is_active)
                        <span class="status-active">Sim</span>
                    @else
                        <span class="status-inactive">Não</span>
                    @endif
                </td>
                <td>{{ $local->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Relatório gerado em {{ now()->format('d/m/Y \à\s H:i') }} | 
        Total de registros: {{ $locals->count() }}
    </div>
</body>
</html>