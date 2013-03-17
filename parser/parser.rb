require 'CSV'

class String
	def is_number?
		true if Float(self) rescue false
	end
end

def syntax(message = nil)
	puts message unless message.nil?
	puts "Syntax: ./parser.rb [csv|xml|ids]"
	exit
end

if ARGV[0].nil?
	syntax("Please specify the first argument.")
end

dir = 'sources/anexa/'
idMinistere = []
idAltele = []
idSectiuni = []

puts '"IdInstitutie","IdParinte","Sectiune","An","NumeInstitutie","DenumireIndicator","Suma"'

Dir.glob(dir + '*.csv') do |file|
	next if file.start_with?(dir+'sinteza')

	csv = CSV.read(file)
	section = 'none'

	numeInstitutie = csv[0][0].to_s + " " + csv[1][0].to_s + " " + csv[2][0].to_s
	numeInstitutie.strip!.capitalize!

	idInstitutie = file
	idInstitutie.slice!(dir)
	idInstitutie = idInstitutie[0,2]

	idParinte = 0

	an = 2013

	csv.each do |row|

		firstRow = row.first.to_s.strip
		section = firstRow if firstRow.to_s.is_number?

		unless section == 'none' or row[-2].nil?
			denumireIndicator = row[-2].to_s.strip
			suma = row[-1].to_s.strip.delete(',')

			if ARGV[0] == "ids"
				if idParinte == 0
					if numeInstitutie.start_with?("Minister")
						idMinistere.push(idInstitutie) unless idMinistere.include?(idInstitutie)
					else
						idAltele.push(idInstitutie) unless idAltele.include?(idInstitutie)
					end
				end
				idSectiuni.push(section) unless idSectiuni.include?(section)
			elsif ARGV[0] == "csv"
				puts '"'+idInstitutie+ '","' + idParinte.to_s + '","' + section + '","' +
						an.to_s + '","' + numeInstitutie + '","' + denumireIndicator + '","' +
						suma + '"'
			elsif ARGV[0] == "xml"
				puts "new id " + idInstitutie if idParinte == 0
			end

			idParinte = idInstitutie
		end

	end
end

if ARGV[0] == "ids"
	puts "["+idMinistere.join(",")+"]"
	puts "["+idAltele.join(",")+"]"
	puts "["+idSectiuni.join(",")+"]"
end
